   @extends('layouts.cmatMPO_dash')



@section('page_heading','NIVELACIJE ZAGLAVLJE')
@section('section')


<div>
            <div class="row col-12">
                <div class="col-md-4 col-xs-12">
                    <form  id='forma'>
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
                <!-- tabela sa filterima -->
                <div class="col-md-8 col-xs-12">
                    <div class="col-12">
                       {{--  <div class='row col-xl-12 mb-1'>
                                <label class="col-3 col-sm-12">Odabrana nivelacija:</label>
                                 <select name="broj_nivelacije" class="form-control col-9 col-sm-12" id="objekat">
                                                   
                                </select>
                            </div> --}}
                        
                    </div>
                    {{-- <div class="row col-12"> --}}
                        <table class="table table-bordered" style="width: 100%;"  id="tblNivelacije">
                            <thead>
                                <th>BROJ</th>
                                <th>DATUM</th>
                                <th>RADNJA</th>
                              
                          
                            </thead>
                        </table>
                        <button class="btn btn-danger" id="obrisi">OBRISI</button>
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


<script>
    var sqlCeo = '';
    var tblNivelacije = $('#tblNivelacije').DataTable({
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
              
             
                    
                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });
     $("#forma").submit(function(e) {
            e.preventDefault();
            
            $.get("{{ route('nivelacijeZaglavljeUnos') }}",{
                datum : $('#datum').val(),
           
                    orgjed : $('#objekat').val(),
                 
            },function(d){
                if (d != ''){
                  alert(d);
                }
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
                $.get("nivelacijeZaglavljeBrisanje",{
                pretraga:idKolone
       
             
            },function(result){
                
             tblNivelacije.ajax.reload();
                  });
            }

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