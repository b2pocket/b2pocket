   @extends('layouts.admin_dash')



@section('page_heading','NIVELACIJE STAVKE')
@section('section')


<div>
            <div class="row col-12">
                <div class="col-md-4 col-xs-12">
                    <form  id='forma'>
                        <div >
                          {{--   <div class='row col-xl-12 mb-1'>
                                <label class="col-3  col-sm-12">Datum:</label>
                                <input class="form-control col-9  col-sm-12" for="validationDefault05" type="text" id="datum" required readonly>
                            </div> --}}
                            <div class='row col-xl-12 mb-3 justify-content-around'>
                                <label class="col-12 mt-2">Pretraga artikla: -> minimum 3 karaktera za pretragu</label>
                                <input class="form-control col-5" for="validationDefault05" type="text" id="artikal_sifra_pretraga" placeholder="po barkodu" >
                                <input class="form-control col-5" for="validationDefault05" type="text" id="artikal_naziv_pretraga" placeholder="po nazivu" >
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3 col-sm-12">Izabrani atikal:</label>
                                 <select name="artikal_sifra" class="form-control col-9 col-sm-12" id="artikal_sifra">
                                                   
                                </select>
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3 col-sm-12">Koliicna:</label>
                                <input class="form-control col-9 col-sm-12" step="any" for="validationDefault05" type="number" id="kolicina" placeholder="kolicina" required>
                         
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3 col-sm-12">Stara cena:</label>
                                <input class="form-control col-9 col-sm-12" for="validationDefault05" type="number" step="any" id="stara_cena" placeholder="stara_cena" required >
                           
                            </div>
                             <div class='row col-xl-12 mb-1'>
                                <label class="col-3 col-sm-12">Nova cena:</label>
                                <input class="form-control col-9 col-sm-12" for="validationDefault05" type="number" step="any" id="nova_cena" placeholder="nova_cena" required>
                     
                            </div>
                          {{--   <div class='row col-xl-12 mb-1'>
                                <label class="col-3 col-sm-12">Objekat:</label>
                                 <select name="objekat" class="form-control col-9 col-sm-12" id="objekat">
                                                   
                                </select>
                            </div> --}}
                            
                        </div> 

                        <button class="btn btn-info  mt-3" type="submit"  id="unos">Unos</button>
                        {{-- <button class="btn btn-success  mt-3" type="button"  id="izmena">Izmena</button> --}}
                        <button class="btn btn-danger mt-3" type='reset' id="reset">Reset</button>
                  </form>
                </div>
                <!-- tabela sa filterima -->
                <div class="col-md-8 col-xs-12">
                  {{--   <div class="col-12 mb-3">
                        <div class='row col-xl-12 mb-1'>
                                <label class="col-3 col-sm-3">Odaberi nivelaciju:</label>
                                 <select name="broj_nivelacije" class="form-control col-6 col-sm-6" id="nivelacijeselect">
                                      <option>ODABERI NIVELACIJU</option>             
                                </select>
                            </div>
                        
                    </div> --}}
                    <div class="row col-md-12 mb-3">
                       
                      {{--   <div class="col-md-2">
                            
                        </div>
                        <div class="col-md-2">
                             
                        </div> --}}
                        <div class="col-md-12 mb-3">
                            <div class="ml-2" >
                               <button type="button" 
                                       class="btn btn-primary btn-circle"  
                                       
                                       data-toggle="modal"
                                       data-placement="bottom" 
                                       data-target="#modalSelektovanjeNivelacije"
                                       title="SELEKTOVATI NIVELACIJU"
                                       id="prikaziZaglavlja">ODABIR NIVELACIJE
                                       <i class="fa fa-list"></i>
                                </button>
                                <button type="button" 
                                       class="btn btn-success btn-circle"  
                                       
                                       data-toggle="modal"
                                       data-placement="bottom" 
                                       data-target="#modalKreirajNivelaciju"
                                       title="SELEKTOVATI NIVELACIJU"
                                       id="kreirajNivelaciju">KREIRAJ NIVELACIJU
                                       <i class="fa fa-plus"></i>
                                </button>

                            </div>
                              

                        </div>
                        <div  id="selektovanoZaglavlje">
                            <label>Broj nivelacije: </label>
                            <button class="btn btn-info" id="brojNiv">BROJ</button>
                            <label>Datum nivelacije: </label>
                             <button class="btn btn-info" id="datumNiv">DATUM</button>
                             <label>Radnja: </label>
                             <button class="btn btn-info" id="orgjedNiv">RADNJA</button>

                             <button class="btn btn-success" id="stampajPotvrdu">STAMPA NIVELACIJE</button>
                        </div>
                        
                    </div>
                   {{--  <div class="col-12 mb-2">
                        <button class="btn btn-info ">asdadadad</button>
                        
                    </div> --}}
                    {{-- <div class="row col-12"> --}}
                        <table class="table table-bordered" style="width: 100%;"  id="tblNivelacije">
                            <thead>
                                <th>ID</th>
                                <th>NIVELACIJA BROJ</th>
                                <th>SIFRA ARTIKLA</th>
                                 <th style="min-width: 300px;">ARTIKAL</th>
                                <th>KOLICINA</th>
                                <th>STARA CENA</th>
                                <th>NOVA CENA</th>
                                <th>OBJEKAT</th>
                                <th>DATUM</th>
                                <th>KORISNIK</th>
                        
                          
                            </thead>
                        </table>
                        <button class="btn btn-danger" id="obrisi">OBRISI SELEKTOVANU NIVELACIJU</button>
                       {{-- </div> --}}
                </div>
            </div>
   
    <!-- modal za prikaz sql -->
    <div class="container"> 
        <div id="prikaz" class="modal fade">`
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="forma-izmena">
                        <div class="modal-header">                      
                            <h4 class="modal-title">SQL</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body my-3">                   
                            <div class='form'>
                                <div class='col-xl-10 offset-1 my-1'>
                                <textarea class="form-control language-sql" id="prikaz2" rows="30" for="validationDefault05" type="text" readonly ></textarea>
                                </div>
                            </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalSelektovanjeNivelacije">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Nivelacije</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="col-md-12"> 
        <table class="table table-bordered" style="width: 100%;"  id="tblNivelacijeZaglavlje">
                            <thead>
                                <th>BROJ</th>
                                <th style="min-width: 150px;">DATUM</th>
                                <th>RADNJA</th>
                                <th>NAZIV</th>
                              
                          
                            </thead>
                        </table>
      </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<div class="modal" id="modalKreirajNivelaciju">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Kreiranje nivelacije</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="col-md-12"> 
       
                 <div class="col-md-12 col-xs-12">
                    <form  id='formak'>
                        <div >
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3  col-sm-12">Datum:</label>
                                <input class="form-control col-9  col-sm-12" for="validationDefault05" type="text" id="datum" required readonly>
                            </div>
                            
                          
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3 col-sm-12">Objekat:</label>
                                 <select name="objekat" class="form-control col-9 col-sm-12" id="objekat">
                                                   
                                </select>
                            </div>
                            
                        </div> 

                        <button class="btn btn-info  mt-3" type="submit"  id="unos">Unos</button>
                        {{-- <button class="btn btn-success  mt-3" type="button"  id="izmena">Izmena</button> --}}
                        {{-- <button class="btn btn-danger mt-3" type='reset' id="reset">Reset</button> --}}
                  </form>
                </div>
      </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
    
    var sqlCeo = '';



    $ ( document ).ready(function() {
      $('#stampajPotvrdu').click(function(){

          window.open(
           
                    'http://b2me.rs/dev_b2pocket/app/Http/Controllers/cmatMPO/jasperStampa.php?id='+$('#brojNiv').text(),
                    '_blank'
                    );

      });

      $("#formak").submit(function(e) {
            e.preventDefault();
            var datumS = '';
            datumS = $('#datum').val();
            if (datumS == ''){
              alert('Morate uneti datum!!')
              return false;
            }
            $.get("{{ route('nivelacijeZaglavljeUnos') }}",{
                datum : $('#datum').val(),
           
                    orgjed : $('#objekat').val(),
                 
            },function(d){
                if (d != ''){
                  alert(d);
                }

                tblNivelacijeZaglavlje.ajax.reload();

                popuniNivelacijeZaglavljaTbl();


                $('#selektovanoZaglavlje').show();


                       




                $('#modalKreirajNivelaciju').modal('toggle');
                //$("#forma").closest('form').find("input[type=text], textarea").val(""); //reset input polja u formi
            });
        });
          $('#selektovanoZaglavlje').hide();
    //document.getElementById('selektovanoZaglavlje').style.display = 'none';
    var tblNivelacijeZaglavlje = $('#tblNivelacijeZaglavlje').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,

          
                ajax:{
                    url:  "{{ route('nivelacijeZaglavljeSpisak') }}",
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },
                   
                columns:[

                        { data: 'id' },
                        { data: 'datum' },
                        { data: 'orgjed' },
                        { data: 'nazobj' },
              
             
                    
                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });
    $('#prikaziZaglavlja').click(function(){
    tblNivelacijeZaglavlje.ajax.reload();
    });
       var idKolone = '';
   
      // var idnivelacijeSel= '';
        $('#tblNivelacijeZaglavlje tbody').on('click','tr',function(event){
      // var rowID = $('#tblZapisi tbody tr').eq(0).attr('id');
           // idnivelacijeSel = $(this).find('td').eq(0).html();
           $('#brojNiv').text($(this).find('td').eq(0).html());
             $('#datumNiv').text($(this).find('td').eq(1).html());
             $('#orgjedNiv').text($(this).find('td').eq(2).html());
            
            //popuniNivelacijeZaglavljaTbl();
            $param = $(this).find('td').eq(0).html()
              urlNivelacije = "{{ route('nivelacijeSpisak', ['broj' =>':broj']) }}";
            urlNivelacije = urlNivelacije.replace(':broj',$param);
                                     tblNivelacije.ajax.url(urlNivelacije).load();         
            $('#selektovanoZaglavlje').show();
            $('#modalSelektovanjeNivelacije').modal('toggle');

    

          
    });
           function popuniNivelacijeZaglavljaTbl()

            {
                
                //alert($('#selektovaniRed').text());
                $.get("nivelacijeZaglavljePoslednji",{
               // pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);\
               var brRedova=obj.length;
            
                        
                       for (var i = 0; i < brRedova; i++) 
                        {
                          
                              $('#brojNiv').text(obj[i].id);
                        $('#datumNiv').text(obj[i].datum);
                        $('#orgjedNiv').text(obj[i].nazobj);

                      //  alert(obj[i].id);
                urlNivelacije = "{{ route('nivelacijeSpisak', ['broj' =>':broj']) }}";
            urlNivelacije = urlNivelacije.replace(':broj',obj[i].id);
                                     tblNivelacije.ajax.url(urlNivelacije).load();   

                               
                        }

                      
                                     
                  });
          
               
        

            }


         $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

    var   urlNivelacije = "{{ route('nivelacijeSpisak', ['broj' =>'0']) }}";
    var tblNivelacije = $('#tblNivelacije').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                serverSide:false,
                searching:false,

          
                ajax:{
                    url:  urlNivelacije,
                        "type": "GET",
                        data:function(){
                         // idnivelacije:$('#nivelacijeselect').val()
                                       },
                        dataSrc: ''
                    },
                   
                columns:[
                        { data: 'id' },
                        { data: 'idnivelacije' },  
                        { data: 'artikal_sifra' },
                        { data: 'naziv' },
                        { data: 'kolicina'},
                        { data: 'stara_cena' },
                        { data: 'nova_cena' },
                        { data: 'nazobj' },
                        { data: 'datum' },
                        { data: 'name' },
                       
             
                    
                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });

     $('#nivelacijeselect').change(function(){
        if ($('#nivelacijeselect').val() != 'N') {

            urlNivelacije = "{{ route('nivelacijeSpisak', ['broj' =>':broj']) }}";
            urlNivelacije = urlNivelacije.replace(':broj', $('#nivelacijeselect').val());
                                     tblNivelacije.ajax.url(urlNivelacije).load();
                                     }
                              
                                 });

     $("#forma").submit(function(e) {
            e.preventDefault();
           
            if ($('#brojNiv').text() == 'BROJ')
            {
                 alert('Morate selektovati nivelaciju!!');
                 return false;
            }

            // if ($('#nivelacijeselect').val()=='N')
            // {
            //     alert('Morate selektovati nivelaciju!!');
            //     return false;
            // }
            $.get("{{ route('nivelacijeUnos') }}",{
                datum : $('#datum').val(),
                artikal_sifra : $('#artikal_sifra').val(),
                 kolicina : $('#kolicina').val(),
                  stara_cena : $('#stara_cena').val(),
                   nova_cena : $('#nova_cena').val(),
                    orgjed : $('#objekat').val(),
                     idnivelacije : $('#brojNiv').text(),
                 
            },function(d){
                if (d != ''){
                  alert(d);
                }
               // alert(urlNivelacije);
                tblNivelacije.ajax.reload();


            
                //$("#forma").closest('form').find("input[type=text], textarea").val(""); //reset input polja u formi
            });
        });

       



      

//     var idKolone = '';
//     var sqlPrikaz = '';
//    $(document).ready(function(){
    var idKolone = '';
        $('#tblNivelacije tbody').on('click','tr',function(event){
      // var rowID = $('#tblZapisi tbody tr').eq(0).attr('id');
            idKolone = $(this).find('td').eq(0).html();

            //sqlPrikaz = $(this).find('td').eq(6).html();
         //   alert('usao'+rowID);
            //$('#prikaz2').val(sqlPrikaz);

          
    });
//          $( "#tblZapisi tbody" ).on( "click","#pregledSql", function( event ){
           
//                 var data = tblZapisi.row($(this).parents('tr')).data();              
//                 var sql =data.sql;
//                 $('#prikaz2').val(sql);
            
//                 });
// });
        $('#obrisi').click(function(){
            if (idKolone == '')
            {
                alert('Morate selektovati red u tabeli!!');
                return false;
            }
            else
            {
                $.get("nivelacijeBrisanje",{
                pretraga:idKolone
       
             
            },function(result){
                
             tblNivelacije.ajax.reload();
                  });
            }

        });

    });
</script>
<script>
  $("#datum").datepicker({ onSelect: function () {  },

                 monthNamesShort: [ "Januar", "Februar", "Mart", "April", "Maj", "Juni", "Juli", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar" ],
        dayNamesMin: ['Ned', 'Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub'],
        dateFormat: "mm.dd.yy",
        firstDay: 1,    
      
        numberOfMonths: 1,



             changeMonth: true, changeYear: true });
  function popuniArtikle(param)

            {
                
                //alert($('#selektovaniRed').text());
                $.get("nivelacijeArtikli",{
                pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#artikal_sifra").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#artikal_sifra").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].naziv)
                                                        .val(obj[i].sifra)
                                                   ); 
                                              
                        }

                  });
               
        

            }
         
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
              function popuniNivelacijeZaglavlja()

            {
                
                //alert($('#selektovaniRed').text());
                $.get("nivelacijeZaglavljeSpisak",{
               // pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#nivelacijeselect").empty();
                       $("#nivelacijeselect").append(
                                                    $("<option></option>") 
                                                        .text('ODABERI NIVELACIJU')
                                                        .val('N')
                                                   ); 
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {
                          

                                $("#nivelacijeselect").append(
                                                    $("<option></option>") 
                                                        .text('Broj: '+obj[i].id+' - Datum: '+obj[i].datum+' - Objekat: '+obj[i].nazobj)
                                                        .val(obj[i].id)
                                                   ); 
                                              
                        }


                  });
          
               
        

            }
                  popuniNivelacijeZaglavlja();
                   function popuniObjekte()

            {
                
                //alert($('#selektovaniRed').text());
                $.get("nivelacijeObjekti",{
               // pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#objekat").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {
                          

                                $("#objekat").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].nazobj)
                                                        .val(obj[i].sifobj)
                                                   ); 
                                              
                        }

                  });
          
               
        

            }
                  popuniObjekte();
   
          
</script>
@endsection