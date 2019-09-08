   @extends('layouts.admin_dash')



@section('page_heading','ZAPOSLENJA')
@section('section')




            <div class="row col-12">

            	 <div class="col-md-4  col-xs-12 mb-2">
                    <form  id='forma'>
                        <div >
                  
                        
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">RADNIK:</label>
                                </div>
                                <div class="col-auto">
                                       <select class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" id="zaposlenja_unos_kadrovi">
                                 
                                    </select>
                                </div>
                            </div>
                            
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">RADNJA:</label>
                                </div>
                                <div class="col-auto">
                                       <select class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" id="zaposlenja_unos_radnja">
                                 
                                    </select>
                                </div>
                            </div>
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12 text-nowrap">Datum OD:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="text" id="zaposlenja_datum_od" placeholder="datum od" required readonly>
                                </div>
                         
                            </div>
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12 text-nowrap">Datum DO:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="text" id="zaposlenja_datum_do" placeholder="datum do" required readonly>
                                </div>
                         
                            </div>
                            
                            
                           
                      

                        </div> 

                        <button class="btn btn-info  mt-3" type="submit"  id="unos">Unos</button>
                        {{-- <button class="btn btn-success  mt-3" type="button"  id="izmena">Izmena</button> --}}
                        <button class="btn btn-danger mt-3" type='reset' id="reset">Reset</button>
                  </form>
                </div>
               
                <!-- tabela sa filterima -->
                <div class="col-md-8 col-xs-12">
                        {{-- <button class="btn btn-success mb-2" id="stampajPotvrdu">STAMPA KALKULACIJE</button> --}}
                        <table class="table table-bordered" style="width: 100%;"  id="tblZaposlenja">
                            <thead>
                                <th>ID</th>
                                <th>KADROVIID</th>
                                <th>PREZIME</th>
                                <th>IME</th>
                                <th>DATUM OD</th>
                                 <th>DATUM DO</th>
                                 <th>RADNJA SIFRA</th>
                                  <th>RADNJA NAZIV</th>
                               

                            </thead>
                        </table>
              
                </div>
            </div>


      <script>
      	
      	var tblZaposlenja = $('#tblZaposlenja').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,


          
                ajax:{
                    url:  "{{ route('zaposlenjaSpisak') }}",
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },

                columns:[

                        { data: 'id' },
                        { data: 'kadroviid' },
                        { data: 'prezime' },
                        { data: 'ime' },
                        { data: 'datumod' },
                        { data: 'datumdo' },
                        { data: 'orgjed' },
                        { data: 'nazobj' },

                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });



                   $("#zaposlenja_datum_od,#zaposlenja_datum_do").datepicker({ onSelect: function () {  },

                 monthNamesShort: [ "Januar", "Februar", "Mart", "April", "Maj", "Juni", "Juli", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar" ],
        dayNamesMin: ['Ned', 'Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub'],
        dateFormat: "mm.dd.yy",
        yearRange: '1910:2025',
        firstDay: 1,    
        numberOfMonths: 1,
             changeMonth: true, changeYear: true });

            $("#forma").submit(function(e) {
		            e.preventDefault();
		          
		            $.get("{{ route('zaposlenjaUnos') }}",{
		                kadroviid : $('#zaposlenja_unos_kadrovi').val(),
		                orgjed : $('#zaposlenja_unos_radnja').val(),
		                datumod : $('#zaposlenja_datum_od').val(),
		                datumdo : $('#zaposlenja_datum_do').val(),
		              
		            },function(d){
		                if (d != ''){
		                  alert(d);
		                  console.log(d);
		                }
		        //alert(d);
		                tblZaposlenja.ajax.reload();

		                $('#forma').trigger("reset");
		        
		            });
        });
        function popuniKadrove(param)

            {
                
                //alert($('#selektovaniRed').text());
                $.get("zaposlenjaKadrovi",{
                pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#zaposlenja_unos_kadrovi").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#zaposlenja_unos_kadrovi").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].ime+' '+obj[i].prezime)
                                                        .val(obj[i].id)
                                                   ); 
                                              
                        }

                  });
               
        

            }
            popuniKadrove('param');

            function popuniRadnje(param)

            {
                
                //alert($('#selektovaniRed').text());
                $.get("zaposlenjaRadnje",{
                pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#zaposlenja_unos_radnja").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#zaposlenja_unos_radnja").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].nazobj)
                                                        .val(obj[i].orgjed)
                                                   ); 
                                              
                        }

                  });
               
        

            }
            popuniRadnje('param');

      </script>



@endsection