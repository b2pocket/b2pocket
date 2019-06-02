   @extends('layouts.admin_dash')



@section('page_heading','ZAPISI')
@section('section')


<div>
            <div class="row">
               
                <div class="col-4 ">
                     <form id="forma">
                        <div >
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3">Naziv:</label>
                                <input class="form-control col-9" for="validationDefault05" type="text" id="naziv" required>
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3">Opis:</label>
                                <input class="form-control col-9" for="validationDefault05" type="text" id="opis" required>
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3">Uputstvo:</label>
                                <input class="form-control col-9" for="validationDefault05" type="text" id="uputstvo" >
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3">Kategorija:</label>
                                <select class="form-control col-9" id="kategorija" required>
                                   
                                </select> 
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3">Jezik:</label>
                                <select class="form-control col-9" id="jezik" required>
                                   
                                </select> 
                            </div>
                            <div class='row col-xl-12 mb-1'>
                                <label class="col-3">SQL QUERY:</label>
                                <textarea class="form-control col-9" id="sql" rows="13" for="validationDefault05" type="text" required></textarea>
                            </div>
                        </div> 

                        <button class="btn btn-info  mt-3" type="submit"  id="unos">Unos</button>
                        <button class="btn btn-success  mt-3" type="button"  id="izmena">Izmena</button>
                        <button class="btn btn-danger mt-3" type='reset' id="reset">Reset</button>
                   </form>
                </div>
           
                <!-- tabela sa filterima -->
                <div class="col-8">
                    <div class="row col-12 mb-2">
                        <div class='col-xl-6'>
                            <label>Filter kategorije:</label>
                            <select class="form-control" id="filterKategorije" required>
                            <option value="999">SVE</option>
                            
                            </select> 
                        </div>
                        <div class='col-xl-6'>
                            <label>Filter jezik:</label>
                            <select class="form-control" id="filterJezika" required>
                            <option value="999">SVE</option>
                              
                            </select> 
                        </div>
                    </div>
                    <table class="table table-bordered" id="tblZapisi">
                        <thead>
                            <th>ID</th>
                            <th>NAZIV</th>
                            <th style="min-width: 300px;">OPIS</th>
                            <th style="min-width: 300px;">UPUTSTVO</th>
                            <th>KATEGORIJA</th>
                            <th>JEZIK</th>
                            <th>SQL</th>
                            
                            <th>SISDATUM</th>
                            <th>KORISNIK</th>
                      
                            <th>+</th>
                        </thead>
                    </table>
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
    var tblZapisi = $('#tblZapisi').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,
                fixedColumns:true,
    
                //scrollCollapse: true,
                
               
                ajax:{
                    url:  "{{ route('zapisiSqlLogger') }}",
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },
                   
                columns:[

                        { data: 'id' },
                        { data: 'naziv' },
                        { data: 'opis' },
                        { data: 'uputstvo'},
                        { data: 'kategorija' },
                        { data: 'jezik' },
                        { data: 'sql' },
                       
                        { data: 'sisdatum' },
                        { data: 'korisnik' },
                      
                          { data: "AKCIJE", 'render': function (data, type, row) { 
                          //console.log(row['sql']);
            return '<a href="#prikaz" id="pregledSql"  class="show" data-toggle="modal"><i class="fas fa-eye" style="color:blue;" data-toggle="tooltip" title="Prikazi"></i></a>'
           
                }} 
                        ],
                          "rowCallback": function(row, data, index) {
        var cellClass = data["id"];
        $("td:eq(6)",row).addClass('sql_logger');
        $("td:eq(4)",row).addClass('sql_logger_kolona_uputstvo');
                            },
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }],
                             fixedColumns:   {
                            leftColumns: false,
                            rightColumns: 1
                                },
        });
    var idKolone = '';
    var sqlPrikaz = '';
    $(document).ready(function(){
        $('#tblZapisi tbody').on('click','tr',function(event){
       var rowID = $('#tblZapisi tbody tr').eq(0).attr('id');
            idKolone = $(this).find('td').eq(0).html();

            //sqlPrikaz = $(this).find('td').eq(6).html();
         //   alert('usao'+rowID);
            //$('#prikaz2').val(sqlPrikaz);

          
    });
         $( "#tblZapisi tbody" ).on( "click","#pregledSql", function( event ){
           
                var data = tblZapisi.row($(this).parents('tr')).data();              
                var sql =data.sql;
                $('#prikaz2').val(sql);
            
                });
});

     // $("#forma").submit(function(e) {
     //        e.preventDefault();
           
     //        if ($('#brojNiv').text() == 'BROJ')
     //        {
     //             alert('Morate selektovati nivelaciju!!');
     //             return false;
     //        }

     //        // if ($('#nivelacijeselect').val()=='N')
     //        // {
     //        //     alert('Morate selektovati nivelaciju!!');
     //        //     return false;
     //        // }
     //        $.get("{{ route('nivelacijeUnos') }}",{
     //            naziv : $('#datum').val(),
     //            opis : $('#artikal_sifra').val(),
     //             uputstvo : $('#kolicina').val(),
     //              stara_cena : $('#stara_cena').val(),
     //               nova_cena : $('#nova_cena').val(),
     //                orgjed : $('#objekat').val(),
     //                 idnivelacije : $('#brojNiv').text(),
                 
     //        },function(d){
     //            if (d != ''){
     //              alert(d);
     //            }
      
     //            tblNivelacije.ajax.reload();


     //        });
     //    });

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