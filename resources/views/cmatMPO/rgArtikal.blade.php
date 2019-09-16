   @extends('layouts.admin_dash')



@section('page_heading','MAPIRANJE ARTIKALA')
@section('section')


                    
            <div class="row col-12">
                 <div class="row col-12 form-group">
                    <label class="mr-2">Firma:</label>
                    <select class="form-control col-2 mb-1" id="firma">

                              @foreach ($firme as $firma)
                                <option value="{{$firma->id}}">{{$firma->naziv}}</option>
                                @endforeach
                        </select>
                     
                 </div>
            	 <div class="col-md-4  col-xs-12 mb-2">
                    <form  id='forma'>
                        <div >
                  
                        
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Artikal:</label>
                                </div>
                                <div class="col-auto">
                                     <label id="selRadnik"></label>
                                </div>
                            </div>
                            
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Robna grupa:</label>
                                </div>
                                <div class="col-auto">
                                       <select class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" id="rgSel">
                                 
                                    </select>
                                </div>
                            </div>
                           
                            
                            
                           
                      

                        </div> 

                        <button class="btn btn-info  mt-3" type="submit"  id="unos">Izmeni</button>
                        {{-- <button class="btn btn-success  mt-3" type="button"  id="izmena">Izmena</button> --}}
                        <button class="btn btn-danger mt-3" type='reset' id="reset">Reset</button>
                  </form>
                </div>
               
                <!-- tabela sa filterima -->
                <div class="col-md-8 col-xs-12">
                		<div class="col-12 mb-2">
							<select id="filterStatus" class="form-control col-2">
								<option value="-1">NEKLASIFIKOVANI</option>
								<option value="SVI">KLASIFIKOVANI</option>
								
							</select>
							
						</div>
						<div class="col-12">
                        {{-- <button class="btn btn-success mb-2" id="stampajPotvrdu">STAMPA KALKULACIJE</button> --}}
	                        <table class="table table-bordered" style="width: 100%;"  id="tblArtikal">
	                            <thead>
	                                <th>SIFRA</th>
	                                <th>NAZIV</th>
	                                <th>RG_SIFRA</th>
	                                <th>ROBNA GRUPA</th>

	                            </thead>
	                        </table>
	                    </div>
              
                </div>
            </div>

<script>
	$.ajaxSetup({
			  headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
		var tblArtikal = $('#tblArtikal').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:true,


          
                ajax:{
                    url:  "{{ route('artikliSpisak') }}",
                        "type": "POST",
                        data:function(d){

                          d.filter = $('#filterStatus').val();
                          d.sema = $('#firma').val();
                                       },
                        dataSrc: ''
                    },

                columns:[

                        { data: 'sifra' },
                        { data: 'naziv' },
                        { data: 'robnagrupa' },
                        { data: 'rg_naziv' }
                  

                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });
        $('#filterStatus,#firma').change(function(){
        	tblArtikal.ajax.reload();
            popuniRg();
        });
        var selektovaniArtikalSifra = '';
          $('#tblArtikal tbody').on('click','tr',function(event){
      
            selektovaniArtikal = $(this).find('td').eq(1).html();
             selektovaniArtikalSifra = $(this).find('td').eq(0).html();
            $('#selRadnik').text(selektovaniArtikal);

    });


            $("#forma").submit(function(e) {
		            e.preventDefault();
		          if (selektovaniArtikalSifra == ''){
		          	alert('Selektujte artikal');
		          	return false;
		          }
		            
		            	 $.get("{{ route('artikalVeza') }}",{
		                sifra : selektovaniArtikalSifra,
		                robGrupa : $('#rgSel').val(),
                        sema : $('#firma').val()
		      
		                 
		            },function(d){
		                if (d != ''){
		                  alert(d);
		               //   console.log(d);
		                }
		        //alert(d);
		                tblArtikal.ajax.reload();

		                ///$('#forma').trigger("reset");
		        
		            });
        });

             function popuniRg()

            {
                //alert($('#selektovaniRed').text());
                $.get("robneGrupeSpisak",{
                sema: $('#firma').val(),
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
              //  alert(brRedova);
                        $("#rgSel").empty();
                        
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#rgSel").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].naziv)
                                                        .val(obj[i].sifra)
                                                   );   
                        }

                  });
               
        

            }
            popuniRg();
</script>
@endsection