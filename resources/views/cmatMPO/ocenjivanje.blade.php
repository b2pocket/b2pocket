   @extends('layouts.admin_dash')



@section('page_heading','OCENJIVANJE')
@section('section')

<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-auto">
			<select class="form-control" id="mesec">
				
			</select>
		</div>
		<div class="col-auto">
			<select class="form-control" id="kadrovi">
				
			</select>
		</div>
		
	</div>
	<div class="row">
		<div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
			<table class="table table-bordered mojeTabele" style="width: 100%;"  id="tblOcenjivanje">
				<thead>
					<th>ID</th>
					<th>PITANJE</th>
					<th>OCENA</th>
					<th>AKCIJA</th>

				</thead>
			</table>
		</div>
		<div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
			<div class="col-12 mb-2">
				<button class="btn btn-danger" id="obrisi">OBRISI SELEKTOVANU OCENU</button>
				
			</div>
			<div class="col-12">
				<table class="table table-bordered mojeTabele" style="width: 100%;"  id="tblOcenjeni">
					<thead>
						<th>ID</th>
						<th>RADNIK</th>
						<th>PITANJE</th>
						<th>OCENA</th>
						<th>MESEC</th>
					
					</thead>
				</table>
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
				var kadar = '';
				var mesec = '';
		var tblOcenjivanje = $('#tblOcenjivanje').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,


          
                ajax:{
                    url:  "{{ route('oceneZaposleniSpisak') }}",
                        "type": "POST",
                        "data": function(d){
                        	
					         d.mesec =mesec;
					         d.kadar =kadar;
					      },
                      
                        dataSrc: ''
                    },

                columns:[

                        { data: 'id' },
                        { data: 'pitanje' },
                         { data: 'ocena2' },
                         { data: 'akc' },
                      

                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });

        var tblOcenjeni = $('#tblOcenjeni').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,


          
                ajax:{
                    url:  "{{ route('ocenjeniSpisak') }}",
                        "type": "POST",
                      "data": function(d){
                        	
					         d.mesec =mesec;
					         d.kadar =kadar;
					      },
                        dataSrc: ''
                    },

                columns:[

                        { data: 'id' },
                        { data: 'ime' },
                         { data: 'pitanje' },
                          { data: 'ocena' },
                           { data: 'mesec' },
                      

                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });


        var date = new Date();
        date.setMonth(date.getMonth() - 1);
        
        var mesecPre = date.getMonth()+1;
        var godina = date.getFullYear();
        if (mesecPre <10 ){
        	mesecPre = '0'+mesecPre;
        }

        $("#mesec").append(
                                                    $("<option></option>") 
                                                        .text(godina+'.'+mesecPre)
                                                        .val(godina+'.'+mesecPre)
                                                   ); 

          function popuniKadrove(param)

            {
                
                //alert($('#selektovaniRed').text());
                $.get("zaposlenjaKadrovi",{
                pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#kadrovi").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#kadrovi").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].ime+' '+obj[i].prezime)
                                                        .val(obj[i].id)
                                                   ); 
                                              
                        }
                   		
                   		kadar = $("#kadrovi").val();
                   		mesec = $("#mesec").val();
                  
                   		// $('#tblOcenjivanje').DataTable().ajax.reload()
                        tblOcenjivanje.ajax.reload();
                        tblOcenjeni.ajax.reload();

                  });
               
        

            }
            popuniKadrove('param');
     

			  var data = tblOcenjivanje.rows().data();
			  console.log(data);
			 data.each(function (value, index) {
			     console.log(`For index ${index}, data value is ${value}`);
			 });

			 $("#tblOcenjivanje").on("click","button.btn", function() { // any button
				  console.log($(this).val());
				  //alert($(this).find('td').eq(0).html());
				    let tr = $(this).closest('tr');
			    let ocena = tr.find('td:eq(2) select').val();
			    let pitanje = tr.find('td:eq(0)').html();
			    var kadarUnos = $('#kadrovi').val();
			    var mesecUnos = $('#mesec').val();

			  	 $.get("{{ route('ocenjivanjeUnos') }}",{
		                kadroviid :kadarUnos,
		                mesec : mesecUnos,
		                pitanje :pitanje,
		                ocena : ocena
		              
		            },function(d){

		                if (d != ''){
		                  alert(d);
		                  console.log(d);
		                }
		
		                tblOcenjivanje.ajax.reload();
		                tblOcenjeni.ajax.reload();
		        
		            });
	
				});
			  $("#kadrovi").change(function(){
			  	mesec =  $('#mesec').val(); 
			  	kadar =  $('#kadrovi').val();
			  		tblOcenjivanje.ajax.reload();
		                tblOcenjeni.ajax.reload();
			  });

			  $('#obrisi').click(function(){
            if (idKolone == '')
            {
                alert('Morate selektovati red u tabeli!!');
                return false;
            }
            else
            {
                $.get("ocenaBrisanje",{
                pretraga:idKolone
       
             
            },function(result){
                
             tblOcenjeni.ajax.reload();
              tblOcenjivanje.ajax.reload();
                  });
            }

        });

			   var idKolone = '';
        $('#tblOcenjeni tbody').on('click','tr',function(event){
      
            idKolone = $(this).find('td').eq(0).html();

    });


</script>





@endsection