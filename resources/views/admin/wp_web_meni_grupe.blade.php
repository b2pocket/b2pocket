@extends('layouts.admin_dash')


@section('page_heading')
{!!$naslovAplikacije!!}
@endsection
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

<div id="inputModal"  class="modal fade" role="dialog">
  <div class="modal-dialog" id="inputModalDialog">

    <!-- Modal content-->
    <div class="modal-content">
     
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
     
    </div>

  </div>
</div>

<script>

	$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	var tblSetovanja;
	// $.ajaxSetup({timeout:2000});
	 // $.ajaxSetup({async: false});

	         
              		

	function popuniElemente()

            {
            	var url = '{{url('wp_web_meni_grupeR')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';

                $.get(url,{
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
                searching:true,
                 
                  });
                   // DATATABLE INLINE EDITING
				//     tblSetovanja.MakeCellsEditable({
				//         "onUpdate": myCallbackFunction
				//     });
			

				// function myCallbackFunction(updatedCell, updatedRow, oldValue) {
				//     console.log("The new value for the cell is: " + updatedCell.data());
				//     console.log("The old value for that cell was: " + oldValue);
				//     console.log("The values for each cell in that row are: " + updatedRow.data());
				//}
                                   
       	 			}).fail(function() {
					    alert( "error" );
					  })
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

  function refresModala(kojiTip)
			    {
			    		var url = '{{url('wp_web_meni_grupeM')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';
	            return $.get(url,{
	                	tip_modala:kojiTip
				            		},function(result){
				            			//console.log(result);
							            	$(".zaAppend").empty();
							               $(".zaAppend").append(result);

							               $('.zaAppend').find('.datumVreme').datetimepicker({
															 format:'Y-m-d H:i',
														});
							                  $('.zaAppend').find('.datum').datetimepicker({
															 format:'Y-m-d',
														});
							           
							                $('[data-toggle="popover"]').popover({ placement: 'bottom'}); 
							                $('[data-toggle="tooltip"]').popover({ placement: 'bottom'}); 
							                /*$('a[rel=popover]')
											  .popover({ placement: 'bottom', trigger: 'hover' })
											  .addClass('my-super-popover');*/
											//$('.zaAppend').find("#myModal").data('popover').css("z-index", 1060);
							                $('input').click(function(e){
							                	var selektorPolja= $(this);
							                	if (selektorPolja[0].type == "text" && !selektorPolja[0].classList.contains('datumVreme') && !selektorPolja[0].classList.contains('datum'))
							                	{
							                
							               
													    var value = $(this).val();
													    var size  = value.length;
													   
													    //$("#inputModalDialog").dialog("option", { position: [e.pageX, e.pageY] });
													   //    var dialogElm = $("#inputModal .modal-dialog");
														  // var relativeX = $(this).pageX - dialogElm.offset().left;
														  // var relativeY = $(this).pageY - dialogElm.offset().top;
														  //  alert(relativeX + " " + relativeY);  
														  //console.log($('.otvoreniPopover').attr('class'));
														if($('.popover').hasClass('show')){
															
															$('.popover').removeClass('show');
													    }
													    else
													    {
														  $(this).attr('data-content',`<textarea id="textPolja">${value}</textarea>`);
													      $(this).popover('show');
													      // console.log($('.show').find('#textPolja'));
													      // console.log($('.show').find('#textPolja')[0].scrollHeight);
													      $('.show').find('#textPolja')[0].style.height = "";
													    	$('.show').find('#textPolja')[0].style.height = $('.show').find('#textPolja')[0].scrollHeight + "px";
													    }
													    // $('.popover-body').on('keyup','#textPolja', function(e){
													    	
													    // })
													    $('.popover-body').find('#textPolja').css('border','none');
													    $(this).keyup(function(){
													    	if ($('.show').find('#textPolja').length)
													    	{
														    	$('.show').find('#textPolja').val($(this).val());
														    	$('.show').find('#textPolja')[0].style.height = "";
														    	$('.show').find('#textPolja')[0].style.height = $('.show').find('#textPolja')[0].scrollHeight + "px";
														    }	
													    })
													  	$('.popover-body').find('#textPolja').keyup(function(){
													    	selektorPolja.val($(this).val());
													    	this.style.height = "";
													    	this.style.height = this.scrollHeight + "px";
													    	// console.log(this.scrollHeight);

													    })

												}
													    
				    							});
							                $('html').on('click', function(e) {
					  						var prom = e.target.className;//
					  						//alert(prom.parentNode);
					  						//if  (e.target.className != 'popover-body' && e.target.id != 'textPolja')
						  						if  (e.target.tagName == 'DIV')
							  						{
							  							$('.popover').popover('hide');
							  						}
							                	
							                });
							               // console.log('sad');
							            });

	 
                }
         			
						     
            refresModala('FILTRIRANJE');
    function refresTabele()
		    {
		    	var url = '{{url('wp_web_meni_grupeR')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';;
		    	$.ajax({
		            url:url,
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
				                searching:true,
				                  });
		               $('#myModal').modal('hide');
		             
			

		            }
		        });

		    }
            popuniElemente();

 
    $('#tblSetovanja tbody').on('click', '#edit', function ()
            {
          
				(async() => {
									  // console.log('before start');

					await refresModala('EDIT');
			
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

					// 		  console.log('sss');
					// 		  console.log('after start');
				})();
            });
    	$('#tblSetovanja tbody').on('click', '#clone', function ()
            {
            	(async() => {
	            	await refresModala('INSERT');
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
				})();		
            });
        $('#tblSetovanja thead').on('click', '#insert', function ()
            {
        		(async() => {
					await refresModala('INSERT');
					$('#edituj').hide();
					$('#unesi').show();
					$('#pretrazi').hide();
					$('#myModal').modal('show');
				})();	
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
						var url = '{{url('wp_web_meni_grupeE')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';;
            			$.post(url,{

                			jsonEditValues: jsonEditValues
            
				            },function(result){
				                $.notify( result['greska'],
				            		{
				            			className: result['klasa'],
				            			globalPosition: 'bottom right'
				            		});
				               // console.log(result);
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
						var url = '{{url('wp_web_meni_grupeI')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';
            			$.post(url,{

                			jsonEditValues: jsonEditValues
            
				            },function(result){
				            	$.notify( result['greska'],
				            		{
				            			className: result['klasa'],
				            			globalPosition: 'bottom right'
				            		});

				                // console.log(result);
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

