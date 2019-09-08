   @extends('layouts.admin_dash')



@section('page_heading','KALKULACIJE')
@section('section')

	<div class="container-fluid">
			<div class="row col-5 mb-3" id="globalSelectedUkalk">
				<button class="btn btn-primary"><label id="teksSelUkalk"></label>&nbsp;&nbsp;<i class="fa fa-list"></i></button>
			</div>

            <div class="row col-xs-12" id="globalUkalk">

            	 <div class="col-md-4  col-xs-12 mb-2">
                    <form  id='forma'>
                        <div >
                  
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 d-none' >
                                <div class="col-md-12">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Radnja:</label>
                                </div>
                                <div class="col-md-12">
                                    <select name="ukalk_orgjed_unos"  class="form-control  col-lg-9 col-md-12 col-sm-12 col-xs-12" id="ukalk_orgjed_unos">           
                                    </select>
                                </div>
                            </div>
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Dobavljac:</label>
                                </div>
                                <div class="col-auto">
                                    <div class="kalkulacijeSirinaSelecta">
                                        <select name="ukalk_dobav_unos" class="form-control  col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ukalk_dobav_unos" >                  
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12 text-nowrap">Broj dokumenta:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="number" id="ukalk_broj_dokumenta_unos" placeholder="broj dokumenta" required>
                                </div>
                         
                            </div>
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12 text-nowrap">Datum dokumenta:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="text" id="ukalk_datum_dokumenta_unos" placeholder="datum dokumenta" required readonly>
                                </div>
                         
                            </div>
                            
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12 text-nowrap">Datum kalkulacije:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12"  step="any" for="validationDefault05" type="text" id="ukalk_datum_kalkulacije_unos" placeholder="datum kalkulacije" required readonly>
                                </div>
                         
                            </div>
                          {{--   <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">PDV:</label>
                                 <select name="ukalk_pdv_unos" class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12" id="ukalk_pdv_unos">
                                         <option value="20">20%</option>
                                         <option value="10">10%</option>           
                                </select>
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Za uplatu:</label>
                                <input class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="number" id="ukalk_zapla_unos" placeholder="za placanje" required>
                         
                            </div> --}}
                            <div class='row col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1 justify-content-start'>
                                <div class="col-6">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12 text-nowrap">Datum valute:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="text" id="ukalk_datum_valute_unos" placeholder="valuta" required readonly>
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
                        <table class="table table-bordered" style="width: 100%;"  id="tblUkalk">
                            <thead>
                                <th>RADNJA</th>
                                <th>NAZIV</th>
                                <th>BR.KALK</th>
                                <th>DOBAV</th>
                                <th style="min-width: 200px;">NAZIV DOBAVLJACA</th>
                              
                                <th>MESTO DOBAV.</th>

                                <th>BR. DOK</th>
                                <th>DATUM DOKUMEN</th>
                                <th>DATUM KALKULACIJE</th>
                           
                                {{-- <th>PDV</th> --}}
                                {{-- <th>ZAPLA</th> --}}
                                <th>DATUM VALUTE</th>
                                <th>DATUM PREUZIMANJA</th>
                                <th>GODINA BAZE</th>

                            </thead>
                        </table>
                        {{-- <button class="btn btn-danger" id="obrisi">OBRISI SELEKTOVANU NIVELACIJU</button> --}}
                       {{-- </div> --}}
                </div>
            </div>

            <div class="row col-12" id="globalKalk">
                <div class="col-md-4  col-xs-12">
                    <form  id='formaKalk'>
                        <div >
                  
                         {{--    <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Radnja:</label>
                                 <select name="kalk_orgjed_unos" class="form-control  col-lg-9 col-md-12 col-sm-12 col-xs-12" id="kalk_orgjed_unos">
                                                   
                                </select>
                            </div> --}}
                            <div class='row col-xl-12 mb-3 justify-content-around'>
                                <label class="col-12 mt-2">Pretraga artikla: -> minimum 3 karaktera za pretragu</label>
                                <input class="form-control col-5" for="validationDefault05" type="text" id="artikal_sifra_pretraga" placeholder="po barkodu" >
                                <input class="form-control col-5" for="validationDefault05" type="text" id="artikal_naziv_pretraga" placeholder="po nazivu" >
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Artikal:</label>
                                 <select name="kalk_artikal_unos" class="form-control  col-lg-9 col-md-12 col-sm-12 col-xs-12" id="kalk_artikal_unos">
                                                   
                                </select>
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Kolicina:</label>
                                <input class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="number" id="kalk_kolicina_unos" placeholder="kolicina" required>
                         
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-5  col-md-12 col-sm-12 col-xs-12">Nabavna cena bez pdv-a:</label>
                                <input class="form-control col-lg-7 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="number" id="kalk_fakcen_unos" placeholder="nabavna cena" required>
                         
                            </div>
                              <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-5  col-md-12 col-sm-12 col-xs-12">Prodajna cena:</label>
                                <input class="form-control col-lg-7 col-md-12 col-sm-12 col-xs-12" step="any" for="validationDefault05" type="number" id="kalk_prodcen_unos" placeholder="prodajna cena" required>
                         
                            </div>
                           
                           
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Porez:</label>
                                 <select name="kalk_porez_unos" class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12" id="kalk_porez_unos">
                                         <option value="20">20%</option>
                                         <option value="10">10%</option>
                                          <option value="0">0%</option>           
                                </select>
                            </div>
                             <div class='row col-xl-12 mb-1'>
                                <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Broj racuna:</label>
                                <input class="form-control col-lg-9 col-md-12 col-sm-12 col-xs-12"  for="validationDefault05" type="text" id="kalk_poziv_na_broj_unos" placeholder="broj racuna" required>
                         
                            </div>
                            
                      

                        </div> 

                        <button class="btn btn-info  mt-3" type="submit"  id="unos">Unos</button>
                        {{-- <button class="btn btn-success  mt-3" type="button"  id="izmena">Izmena</button> --}}
                        <button class="btn btn-danger mt-3" type='reset' id="reset2">Reset</button>
                  </form>
                </div>
                <!-- tabela sa filterima -->
                <div class="col-md-8 col-xs-12">
                        <button class="btn btn-success mb-2" id="stampajPotvrdu">STAMPA KALKULACIJE</button>
                    <div style="width: 100%;">
                        <table class="table table-bordered" style="width: 100%;"  id="tblKalk">
                            <thead>
                                <th>RADNJA</th>
                                <th>NAZIV</th>
                                <th>BR.KALK</th>
                                <th style="min-width: 150px;">SIFART</th>
                              
                                <th style="min-width: 250px;">NAZART</th>

                                <th>JMERE</th>
                                <th>KOLICINA</th>
                                <th>FAKCEN</th>
                           
                                <th>RUCP</th>
                                <th>TARGR</th>
                                <th>PSPOR</th>
                                <th>POREZ</th>
                                <th>PRODCEN</th>
                                <th>PRODCEN_BEZ_PDV</th>
                                <th>BROJ RACUNA</th>

                            </thead>
                        </table>
                    </div>
                        <button class="btn btn-danger" id="obrisiKalk">OBRISI SELEKTOVANU STAVKU</button>
                    
                </div>
            </div>
        </div>
<script>

		//$('#globalUkalk').hide();
 $ ( document ).ready(function() {

         $('#stampajPotvrdu').click(function(){
        if (selektovaniBrKalk != ''){
          window.open(
           
                    'http://b2me.rs/dev_b2pocket/app/Http/Controllers/cmatMPO/stampaKalkulacije.php?brkalk='+selektovaniBrKalk,
                    '_blank'
                    );

      }
      else
      {
        alert('Selektujte kalkulaciju!!');
      }

      });

	$("#ukalk_datum_kalkulacije_unos").prop("defaultValue", today) 
$('#reset').click(function(){
	
	$("#ukalk_datum_kalkulacije_unos").prop("defaultValue", today) 

});
// GLOBALNE
 		$('#globalKalk').hide();
		 $('#globalSelectedUkalk').hide();



		 // ------------------
 var   urlKalk = "{{ route('kalkSpisak', ['broj' =>'0']) }}";
		 var tblKalk = $('#tblKalk').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,
                fixedHeader:true,
                "bAutoWidth": false,

          
                ajax:{
                    url: urlKalk,
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },


                columns:[

                        { data: 'orgjed' },
                        { data: 'nazobj' },
                         { data: 'brkalk' },
                        { data: 'sifart' },
                        { data: 'nazart' },
                        { data: 'jmere' },
                        { data: 'kolicina' },
                        { data: 'fakcen' },
                        { data: 'rucp' },

                        { data: 'targr' },
                        { data: 'pspor' },
                        { data: 'porez' },
                        { data: 'prodcen' },
                        { data: 'prodcen_bez_pdv' },
                        { data: 'broj_racuna' }
                        

              
             
                    
                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });
		var tblUkalk = $('#tblUkalk').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,


          
                ajax:{
                    url:  "{{ route('ukalkSpisak') }}",
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },

                columns:[

                        { data: 'orgjed' },
                        { data: 'nazobj' },
                        { data: 'brkalk' },
                        { data: 'dobav' },
                        { data: 'nazdob' },
                        { data: 'mesdob' },
                        { data: 'brdok' },
                        { data: 'datdok' },
                        { data: 'datkal' },

                        // { data: 'pdv' },
                        // { data: 'zapla' },
                        { data: 'datval' },
                        { data: 'datum_preuzimanja' },
                        { data: 'godina_baze' },


              
             
                    
                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });


selektovaniBrKalk = '';
		 $('#tblUkalk tbody').on('click','tr',function(event){
		 	selektovaniOrgjed = $(this).find('td').eq(0).html();
		 	selektovaniBrKalk = $(this).find('td').eq(2).html();	
		 		 	//$("#globalUkalk").animate({ width: '500px', height: '500px' }, 300);
		 	            urlKalk = "{{ route('kalkSpisak', ['broj' =>':broj']) }}";
            urlKalk = urlKalk.replace(':broj',$(this).find('td').eq(2).html());
                                     tblKalk.ajax.url(urlKalk).load();

                                     $('#teksSelUkalk').text('OBJEKAT: '+$(this).find('td').eq(1).html()+' - BROJ KALKULACIJE: '+$(this).find('td').eq(2).html());
                                     
			$('#globalUkalk').hide( 300, function() {
			    $( this ).hide();
			    $('#globalSelectedUkalk').show();
			    $('#globalKalk').show();
			  });


 			});
selektovaniArtikal = '';
		  $('#tblKalk tbody').on('click','tr',function(event){

			selektovaniArtikal = $(this).find('td').eq(3).html();

		  });

		 $('#globalSelectedUkalk').click(function(){
 				$('#globalSelectedUkalk').hide();
		 		$('#globalUkalk').show( 300, function() {
			    $( this ).show();
			   	$('#globalKalk').hide();
			  });

		 });

		 	   function popuniObjekte()

            {
                
                //alert($('#selektovaniRed').text());
                $.get("nivelacijeObjekti",{
               // pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#ukalk_orgjed_unos").empty();
                        $("#kalk_orgjed_unos").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {
                          

                                $("#ukalk_orgjed_unos").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].nazobj)
                                                        .val(obj[i].sifobj)
                                                   ); 
                                $("#kalk_orgjed_unos").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].nazobj)
                                                        .val(obj[i].sifobj)
                                                   ); 
                                              
                        }

                  });
          
               
        

            }
                  popuniObjekte();
                  function popuniDobavljace()

            {
                
                //alert($('#selektovaniRed').text());
                $.get("dobavljaciSpisak",{
               // pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#ukalk_dobav_unos").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {
                          

                                $("#ukalk_dobav_unos").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].nazkup1)
                                                        .val(obj[i].sifkup)
                                                   ); 
                                              
                        }

                  });
          
               
        

            }
                  popuniDobavljace();

                   $("#ukalk_datum_dokumenta_unos, #ukalk_datum_valute_unos, #ukalk_datum_kalkulacije_unos").datepicker({ onSelect: function () {  },

                 monthNamesShort: [ "Januar", "Februar", "Mart", "April", "Maj", "Juni", "Juli", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar" ],
        dayNamesMin: ['Ned', 'Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub'],
        dateFormat: "mm.dd.yy",
        firstDay: 1,    
      
        numberOfMonths: 1,



             changeMonth: true, changeYear: true });
                   var today = new Date();
				var dd = String(today.getDate()).padStart(2, '0');
				var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
				var yyyy = today.getFullYear();

				today = mm + '.' + dd + '.' + yyyy;
				$('#ukalk_datum_kalkulacije_unos').val(today);


                     $("#forma").submit(function(e) {
            e.preventDefault();
          
            $.get("{{ route('ukalkUnos') }}",{
                orgjed : $('#ukalk_orgjed_unos').val(),
                dobav : $('#ukalk_dobav_unos').val(),
                brdok : $('#ukalk_broj_dokumenta_unos').val(),
                datdok : $('#ukalk_datum_dokumenta_unos').val(),
                datkal : $('#ukalk_datum_kalkulacije_unos').val(),
                //pdv : $('#ukalk_pdv_unos').val(),
                //zapla : $('#ukalk_zapla_unos').text(),
                datval : $('#ukalk_datum_valute_unos').val()
                 
            },function(d){
                if (d != ''){
                  alert(d);
                  console.log(d);
                }
        //alert(d);
                tblUkalk.ajax.reload();

                $('#forma').trigger("reset");
        
            });
        });
                     $("#formaKalk").submit(function(e) {
            e.preventDefault();
          
            $.get("{{ route('kalkUnos') }}",{
                sifart : $('#kalk_artikal_unos').val(),
                kolicina : $('#kalk_kolicina_unos').val(),
                fakcen : $('#kalk_fakcen_unos').val(),
                prodcen : $('#kalk_prodcen_unos').val(),
                porez : $('#kalk_porez_unos').val(),
                poziv_na_broj : $('#kalk_poziv_na_broj_unos').val(),


                brkalk : selektovaniBrKalk,
                orgjed : selektovaniOrgjed
          
                 
            },function(d){
                if (d != ''){
                  alert(d);
                }
        //alert(d);
                tblKalk.ajax.reload();

                $('#formaKalk').trigger("reset");
        
            });
        });
                       function popuniArtikle(param)

            {
                
                //alert($('#selektovaniRed').text());
                $.get("nivelacijeArtikliKalk",{
                pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#kalk_artikal_unos").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#kalk_artikal_unos").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].naziv)
                                                        .val(obj[i].sifra)
                                                   ); 
                                              
                        }

                  });
               
        

            }
         popuniArtikle('param');
            $('#artikal_sifra_pretraga').keyup(function(){
                $('#artikal_naziv_pretraga').val('');
                var duzina = $('#artikal_sifra_pretraga').val().length;
            
                if (duzina > 2) {
                  // alert('usao')
                 popuniArtikle($('#artikal_sifra_pretraga').val());
                  } 
            });
            $('#artikal_naziv_pretraga').keyup(function(){
                $('#artikal_sifra_pretraga').val('');
                var duzina = $('#artikal_naziv_pretraga').val().length;
            
                if (duzina > 2) {
                  // alert('usao')
                 popuniArtikle($('#artikal_naziv_pretraga').val());
                  } 
            });

            $('#obrisiKalk').click(function(){
            if (selektovaniArtikal == '')
            {
                alert('Morate selektovati red u tabeli!!');
                return false;
            }
            else
            {
                $.get("kalkulacijaBrisanje",{
                kalk:selektovaniBrKalk,
                artikal:selektovaniArtikal
       
             
            },function(result){
            	//alert(result);
                
             tblKalk.ajax.reload();
                  });
            }

        });

});



</script>


@endsection