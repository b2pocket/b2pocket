@extends('layouts.admin_dash')



@section('page_heading','SETOVANJE TRANSFERA')
@section('section')


<div class="row no-gutters">
	
	<div class="col-12 no-gutters">
		<table class="table table-bordered  mojeTabele" style="width: 100%;"  id="tblSetovanja">
				<thead>
					{!! $param !!}
				</thead>
				<tbody>
			

				</tbody>
		</table>
		
	</div>
</div>
<div class="zaAppend"></div>

<script>

	$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	var tblSetovanja;



	function popuniElemente()

            {
                $.get("helenaSetovanjaR",{
                //pretraga:param,
            		},function(result){
            	$("#tblSetovanja tbody").empty();
               $("#tblSetovanja tbody").append(result);
                   tblSetovanja = $('#tblSetovanja').DataTable({

                  	// ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,
                 
                  });
                                   
       	 			});
            };
		
  
            function filtrirajTabelURadni()
            {
            	var tr,i;
            	tr = document.getElementById("tblSetovanja").getElementsByTagName("tr");
          
            	for (i = 1; i < tr.length; i++) 
            	{
			            	var prikazati ='';

			            	//$('#filtriranjeTabele').children('input').each(function () 
			            	$('#forma *').filter(':input').each(function () 
			            		{
					            			var id = this.id;
					            			
					            			var vrednostPolja = this.value;
					            			//console.log(vrednostPolja);
					            			var indexZaTh = $('#tblSetovanja').find(`#${id}`).index();

											var input, filter, table, td, txtValue;
											filter = vrednostPolja;
											//console.log(tr[i]);
					            			td = tr[i].getElementsByTagName("td")[indexZaTh];
					            		//	console.log(indexZaTh);
					            		
					            				if (td) 
									    			{	

									    				txtValue = td.textContent || td.innerText;
									    				if(filter!='')
									    				{
									    							//console.log(filter);
									    					if (txtValue.indexOf(filter) > -1) 
									    					 	{
									    					 		//console.log('Teskt:'+txtValue+'----filter'+filter+'------PRIKAZATI----->'+txtValue.indexOf(filter));
														        	//tr[i].style.display = "";
														      	}
														    else
														    {
														    	//console.log(txtValue+'------NE PRIKAZATI----->'+filter);
														    	prikazati = 'NE';
														    }

									    				}
									    			

									    			}
							    
			            		});
			            	if (prikazati == 'NE')
			            	{
			            		tr[i].style.display = "none";
			            	}
			            	else
			            	{
			            		tr[i].style.display = "";
			        		}
            	}
            	//alert($('#tblSetovanja_info').val());
            }

 function refresModala(prikaz)
		    {
            $.get("helenaSetovanjaKreirajModal",{
                //pretraga:param,
			            		},function(result){
			            	$(".zaAppend").empty();
			               $(".zaAppend").append(result);

			               $('.zaAppend').find('.datum').datetimepicker({
											 format:'Y-m-d H:i',
										});
			               if (prikaz == 'DA')
			               {
			               	$('#myModal').modal('show');
			               }
			            });
 
                }
         
            refresModala('NE');
    function refresTabele()
		    {
		    	
		    	$.ajax({
		            url: '{{url('helenaSetovanjaR')}}',
		            type: 'get',
		           
		            success: function(response) {
		            	$("#tblSetovanja").DataTable().destroy()
		               $("#tblSetovanja tbody").empty();
		               $("#tblSetovanja tbody").append(response);
		               
		                      tblSetovanja = $('#tblSetovanja').DataTable({
		                      
				                scrollY: "50vh",
				                paging: false,
				                scrollX: true,
				                select:true,
				                searching:false,
				                  });
		               $('#myModal').modal('hide');

		            }
		        });

		    }
            popuniElemente();
 
    $('#tblSetovanja tbody').on('click', '#edit', function ()
            {

        		var koloneLista = '{!!$param2!!}';
        		var koloneArr = koloneLista.split(',');

				for(var i = 0; i < koloneArr.length; i++)
				{
					var nazivKolone = koloneArr[i];
					var indexZaTh = $('#tblSetovanja').find(`#${nazivKolone}`).index();
       	 			var textCelije = $(this).closest('tr').find("td").eq(indexZaTh).first().text();
       	 			$('.zaAppend').find(`#${nazivKolone}`).val(textCelije); 
				}
				$('#edituj').show();
				$('#unesi').hide();
				$('#pretrazi').hide();
				$('#myModal').modal('show');
			
					
            });
    	$('#tblSetovanja tbody').on('click', '#clone', function ()
            {
        		var koloneLista = '{!!$param2!!}';
        		var koloneArr = koloneLista.split(',');
				for(var i = 0; i < koloneArr.length; i++)
				{
					var nazivKolone = koloneArr[i];
					var indexZaTh = $('#tblSetovanja').find(`#${nazivKolone}`).index();
       	 			var textCelije = $(this).closest('tr').find("td").eq(indexZaTh).first().text();
       	 			$('.zaAppend').find(`#${nazivKolone}`).val(textCelije); 
				}
				$('#edituj').hide();
				$('#unesi').show();
				$('#pretrazi').hide();
				$('#myModal').modal('show');		
            });
        $('#tblSetovanja tbody').on('click', '#insert', function ()
            {
        	
				$('#edituj').hide();
				$('#pretrazi').hide();
				$('#unesi').show();
				refresModala('DA');
				//$('#myModal').modal('show');		
            });
        $(document).on('click', '#pretrazi', function()
    		{
    			filtrirajTabelURadni();
    			$('#myModal').modal('hide');	
    		});

    	$(document).on('click', '#edituj', function()
    		{
            	 	var nizEditValues = {};
            	 	var koloneLista = '{!!$param2!!}';
            	 	var koloneArr = koloneLista.split(',');

            	 	for(var i = 0; i < koloneArr.length; i++)
						{
							nizEditValues[koloneArr[i]] =$('.zaAppend').find(`#${koloneArr[i]}`).val();

						}
						var jsonEditValues = JSON.stringify(nizEditValues);
					    var $myForm = $('#forma');
					    
					    if(! $myForm[0].checkValidity()) {
						  // If the form is invalid, submit it. The form won't actually submit;
						  // this will just cause the browser to display the native HTML5 error messages.
						  $('<input type="submit">').hide().appendTo($myForm).click().remove();
						  $myForm.find(':submit').click();
						  return false();
						}
            			$.post("helenaEditovanjeTabele",{

                			jsonEditValues: jsonEditValues
            
				            },function(result){
				                $.notify( result['greska'],
				            		{
				            			className: result['klasa'],
				            			globalPosition: 'bottom right'
				            		});
				                //console.log(result);
				                refresTabele();
			            });
			
			
			});
    	$(document).on('click', '#unesi', function(e)
    		{
    				e.stopPropagation();
	            	var nizEditValues = {}; 	
            	 	var koloneLista = '{!!$param2!!}';
            	 	var koloneArr = koloneLista.split(',');

            	 	for(var i = 0; i < koloneArr.length; i++)
						{
							nizEditValues[koloneArr[i]] =$('.zaAppend').find(`#${koloneArr[i]}`).val();

						}
						var jsonEditValues = JSON.stringify(nizEditValues);
					    var $myForm = $('#forma');
					     
					    if(! $myForm[0].checkValidity()) {
					   	$('<input type="submit">').hide().appendTo($myForm).click().remove();
						  $myForm.find(':submit').click();
						
						  return false();
						}
            			$.post("helenaInsertReda",{

                			jsonEditValues: jsonEditValues
            
				            },function(result){
				            	$.notify( result['greska'],
				            		{
				            			className: result['klasa'],
				            			globalPosition: 'bottom right'
				            		});

				                //console.log(result);
				                if (result['klasa'] == 'success' )
				                {
				                	refresTabele();
				            	}	
			            });
			
			
			});

           
            	function funkcijaKlikPretraga()
				{
					
							$('#edituj').hide();
							$('#unesi').hide();
							$('#pretrazi').show();
							$('#myModal').modal('show');
							//refresModala('NE');
								
				}

           
</script>

@endsection