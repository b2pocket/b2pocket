   @extends('layouts.cmatMPO_dash')



@section('page_heading','KADROVI')
@section('section')




            <div class="row col-12">

            	 <div class="col-md-4  col-xs-12 mb-2">
                    <form  id='forma'>
                        <div >
                  
                        
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Prezime:</label>
                                </div>
                                <div class="col-auto">
                                    {{-- <div class="kalkulacijeSirinaSelecta"> --}}
                                        <input class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="text" id="kadrovi_prezime_unos" placeholder="prezime" required>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Ime:</label>
                                </div>
                                <div class="col-auto">
                                    {{-- <div class="kalkulacijeSirinaSelecta"> --}}
                                        <input class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="text" id="kadrovi_ime_unos" placeholder="ime" required>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12 text-nowrap">Pol:</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" id="kadrovi_pol_unos">
                                    	<option value="M">M</option>
                                    	<option value="Z">Z</option>
                                    </select>
                                </div>
                         
                            </div>
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">JMBG:</label>
                                </div>
                                <div class="col-auto">
                                    {{-- <div class="kalkulacijeSirinaSelecta"> --}}
                                        <input class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="number" id="kadrovi_jmbg_unos" placeholder="jmbg" required>
                                    {{-- </div> --}}
                                </div>
                            </div>

                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12 text-nowrap">Datum rodjenja:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="text" id="kadrovi_datum_rodjenja_unos" placeholder="datum rodjenja" required readonly>
                                </div>
                         
                            </div>
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Telefon:</label>
                                </div>
                                <div class="col-auto">
                                    {{-- <div class="kalkulacijeSirinaSelecta"> --}}
                                        <input class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="number" id="kadrovi_telefon_unos" placeholder="telefon" required>
                                    {{-- </div> --}}
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
                        <table class="table table-bordered" style="width: 100%;"  id="tblKadrovi">
                            <thead>
                                <th>ID</th>
                                <th>PREZIME</th>
                                <th>IME</th>
                                <th>POL</th>
                                <th>JMBG</th>
                              
                                <th>DATUM RODJENJA</th>

                                <th>TELEFON</th>
                               

                            </thead>
                        </table>
              
                </div>
            </div>


      <script>
      	
      	var tblKadrovi = $('#tblKadrovi').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,


          
                ajax:{
                    url:  "{{ route('kadroviSpisak') }}",
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },

                columns:[

                        { data: 'id' },
                        { data: 'prezime' },
                        { data: 'ime' },
                        { data: 'pol' },
                        { data: 'jmbg' },
                        { data: 'datumrodjenja' },
                        { data: 'telefon' },

                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });



                   $("#kadrovi_datum_rodjenja_unos").datepicker({ onSelect: function () {  },

                 monthNamesShort: [ "Januar", "Februar", "Mart", "April", "Maj", "Juni", "Juli", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar" ],
        dayNamesMin: ['Ned', 'Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub'],
        dateFormat: "mm.dd.yy",
        yearRange: '1910:2025',
        firstDay: 1,    
        numberOfMonths: 1,
             changeMonth: true, changeYear: true });

            $("#forma").submit(function(e) {
		            e.preventDefault();
		          
		            $.get("{{ route('kadroviUnos') }}",{
		                prezime : $('#kadrovi_prezime_unos').val(),
		                ime : $('#kadrovi_ime_unos').val(),
		                pol : $('#kadrovi_pol_unos').val(),
		                jmbg : $('#kadrovi_jmbg_unos').val(),
		                datumrodjenja : $('#kadrovi_datum_rodjenja_unos').val(),
		                telefon : $('#kadrovi_telefon_unos').val()
		                 
		            },function(d){
		                if (d != ''){
		                  alert(d);
		                  console.log(d);
		                }
		        //alert(d);
		                tblKadrovi.ajax.reload();

		                $('#forma').trigger("reset");
		        
		            });
        });

      </script>



@endsection