@extends('layouts.admin_dash')
@section('page_heading','Android manipulacija')

@section('section')
	
{{-- 	<div class="row col-12 mb-1">
		<div class="btn-group mr-3" role="group" aria-label="Basic example">
		  <button type="button" class="btn btn-info">Korisnici</button>
		  <button type="button" class="btn btn-info">Prava korisnika</button>
		</div>
		
	</div> --}}
   

    <div class="container-fluid">
    	<div class="row">
    	    <div class="container col-sm-8 col-xs-12">
                @if (session('success'))
                    <div id = "uspesnost" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    <script>
                            $("#uspesnost").show();
                        setTimeout(function(){
                            $("#uspesnost").hide();
                        },2000);
                    </script>

                @endif
    			<div class="card card-default">
    					  
    				<div class="card-header" style="background-color: #7386D5;">
    						<h3 class="card-title" class="m_responsive_header">Korisnici</h3>
    						<div class="btn-group mr-1" style="float: left;" role="group" aria-label="Basic example">
    						  <button class="btnUnosIzmena" data-toggle="modal"  id="btnIzmena" data-target="#ModalExample2"><i class="fas fa-user-edit"></i></button>
    						</div>
    					 	<div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
    						  <button class="btnUnosIzmena"  data-toggle="modal" id="btnUnos"  data-target="#ModalExample"><i class="fas fa-user-plus"></i></button>
    						</div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="btnBrisanje" ><i class="fas fa-trash" style="color: red;"></i></button>
                            </div>
                            <button id="selektovaniRed" class="btn ml-2" style="background-color:#17A2B8;"></button>
    					
    				</div>
    						
    				<div class="card-body">
    							<table class="table" style="width: 100%;"  id="tblKorisnici">
    							<thead >
    								<tr>
    									<th id="SIFRA_KLASE">KORISNIK</th>
    									<th>IME</th>
    									<th>PREZIME</th>
    									<th>IMEI</th>
    									<th>PK</th>
    									<th>PROMET_UZIVO</th>
    									<th>PIN</th>
    									<th>BLOKIRAN</th>
    								</tr>
    							</thead>
    						</table>			
    				</div>
    			</div>

    		</div>

  

            <div class="col-sm-4 col-xs-12">
                <div class="card card-default">
                          
                    <div class="card-header" style="background-color: #7386D5;">
                            <h3 class="card-title" class="m_responsive_header">Prava</h3>
                            <div class="btn-group mr-1" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena" id="obrisiPravoNaApp"><i class="fas fa-trash" style="color: red;"></i></button>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal"  data-target="#ModalPovezivanje"><i class="fas fa-tasks"></i></button>
                            </div>
                        
                    </div>
                            
                    <div class="card-body">
                                <table id="pravaNaApp" class="table-bordered" style="width: 100%;" >
                                <thead >
                                    <tr>
                                        <th>APLIKACIJE</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>            
                    </div>
                </div>

            </div>
        </div>
        </div>

	<!-- Modal HTML Markup -->
<div id="ModalExample" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">Unos korisnika</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{ route('upisAndUSer')}}">
                   {{ csrf_field() }} 
                {{--     <input type="hidden" name="_token" value=""> --}}
                   {{--  <div class="form-group">
                        <label class="control-label">E-Mail Address</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="control-label">IMEI</label>
                        <div>
                            <input type="text" placeholder="IMEI..." class="form-control input-lg" name="IMEI" id="IMEI" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">KORISNIK</label>
                        <div>
                            <input type="text" placeholder="KORISNIK..." class="form-control input-lg" name="KORISNIK" id="KORISNIK" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">IME</label>
                        <div>
                            <input type="text" placeholder="IME..." class="form-control input-lg" name="IME" id="IME" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">PREZIME</label>
                        <div>
                            <input type="text" placeholder="PREZIME..." class="form-control input-lg" name="PREZIME" id="PREZIME" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">PK</label>
                        <div>
                            <input type="text" placeholder="PK..." class="form-control input-lg" name="PK" id="PK" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">PIN</label>
                        <div>
                            <input type="text" placeholder="PIN..." class="form-control input-lg" name="PIN" id="PIN" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">BLOKIRAN</label>
                        <div>
                            <input type="text" placeholder="BLOKIRAN..." class="form-control input-lg" name="BLOKIRAN" id="BLOKIRAN" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">EMAIL</label>
                        <div>
                            <input type="text" placeholder="EMAIL..." class="form-control input-lg" name="EMAIL" id="EMAIL" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                        	<label class="control-label">PROMET UZIVO</label>
                            <select name="PROMET_UZIVO" class="form-control" id="PROMET_UZIVO">
                            	<option value="DA">DA</option>
                            	<option value="NE">NE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div >
                            {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info ">Unos</button>
                        </div>
                    </div>
                </form>
            </div>
          
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    <!-- Modal HTML Markup -->
<div id="ModalExample2" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">Izmena korisnika</h4>
            </div>
            <div class="modal-body ">
                <form role="form" method="POST" action="{{ route('updateAndUser')}}">
                   {{ csrf_field() }} 
              
                    <div class="form-group">
                        <label class="control-label">IMEI</label>
                        <div>
                            <input type="text"  placeholder="IMEI..." class="form-control input-lg" name="IMEI" id="IMEI2" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">KORISNIK</label>
                        <div>
                            <input type="text" placeholder="KORISNIK..." class="form-control input-lg" name="KORISNIK" id="KORISNIK2" value="" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">IME</label>
                        <div>
                            <input type="text" placeholder="IME..." class="form-control input-lg" name="IME" id="IME2" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">PREZIME</label>
                        <div>
                            <input type="text" placeholder="PREZIME..." class="form-control input-lg" name="PREZIME" id="PREZIME2" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">PK</label>
                        <div>
                            <input type="text" placeholder="PK..." class="form-control input-lg" name="PK" id="PK2" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">PIN</label>
                        <div>
                            <input type="text" placeholder="PIN..." class="form-control input-lg" name="PIN" id="PIN2" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">BLOKIRAN</label>
                        <div>
                            <input type="text" placeholder="BLOKIRAN..." class="form-control input-lg" name="BLOKIRAN" id="BLOKIRAN2" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">EMAIL</label>
                        <div>
                            <input type="text" placeholder="EMAIL..." class="form-control input-lg" name="EMAIL" id="EMAIL2" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label class="control-label">PROMET UZIVO</label>
                            <select name="PROMET_UZIVO" class="form-control" id="PROMET_UZIVO2">
                                <option value="DA">DA</option>
                                <option value="NE">NE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div >
                            {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info ">Izmeni</button>
                        </div>
                    </div>
                </form>
            </div>
          
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- DODAVANJE PRAVA MODAL --}}
<div id="ModalPovezivanje" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">Unos korisnika</h4>
            </div>
            <div class="modal-body">
           
                    <div class="form-group">
                        <label class="control-label">KORISNIK</label>
                        <div>
                            <input readonly="readonly" type="text" placeholder="IMEI..." class="form-control input-lg" name="IMEI" id="KORISNIK_PRAVO" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label class="control-label">APLIKACIJE</label>
                            <select name="APLIKACIJE_PRAVO" class="form-control" id="APLIKACIJE_PRAVO">
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div >
                            {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button  class="btn btn-info"  id="dodajPravoNaApp">Dodaj pravo</button>
                        </div>
                    </div>
            </div>
          
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <script>
        appSaPRavom='';
        $('#dodajPravoNaApp').click(function(){
           // alert($('#selektovaniRed').text())
        $.get("poveziKorisnikaIAplikaciju",{
                korisnik: $('#selektovaniRed').text(),
                app: $("#APLIKACIJE_PRAVO").val()
              
             
            },function(result){
                //alert(result);
                    popuniSelectUsera();
                    pravaNaApp.ajax.reload();
                    $('#ModalPovezivanje').modal('toggle');

          
            });
        });

        $('#obrisiPravoNaApp').click(function(){
           // alert($('#selektovaniRed').text())
            if (appSaPRavom == '')
           {
            alert('Niste selektovali red!!');
            return false;
           }
        $.get("sakrijAppOdKorisnika",{
                korisnik: $('#selektovaniRed').text(),
                app: appSaPRavom
              
             
            },function(result){
                
                    popuniSelectUsera();
                    pravaNaApp.ajax.reload();
                    

          
            });
        });
        
     
        function popuniSelectUsera()

            {
                //alert($('#selektovaniRed').text());
                $.get("appsnotforuser",{
                korisnik: $('#selektovaniRed').text(),
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#APLIKACIJE_PRAVO").empty();
                        
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#APLIKACIJE_PRAVO").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].aplikacija)
                                                        .val(obj[i].aplikacija)
                                                   );   
                        }

                  });
               
        

            }
          </script>
    <script>
        $('#btnBrisanje').click(function() {
            if ($('#selektovaniRed').text() != ''){
            if (confirm("Da li zelite da obrisete korisnika?")) {
                
    $.ajax({
                url: '{{ route('deleteAndUser')}}',
                type: 'GET',
                data: { KORISNIK: $('#selektovaniRed').text() },
                success: function(response)
                {   
                    //alert(response);
                    zaglavljeKonta.ajax.reload();
                    //$('#something').html(response);

                }
            });

}   
}
else
{
    alert('Morate selektovati korisnika!!');
}  
       });

//$('form').attr('action', 'someNewUrl.php');
    </script>
	<script>
	var pickedup ;
	var pickedup2 ;
	var selektovanoZaglavlje = '';
    var selektovanoPravo = '';
	var selektovaniNeklasifikovani = '';
	var klasifikovaniKonto = '';
	var zaglavljeKonta = $('#tblKorisnici').DataTable({
     
        scrollY: "30vh",
        paging: false,
        scrollX: true,
        select:true,
        searching:false,
        ajax:{
          	url:  "{{ route('androidUsers') }}",
          		"type": "GET",
          		data:function(){
                  //id:1
            				   },
            	dataSrc: ''
        	},
        columns:[
                { data: 'korisnik' },
                { data: 'ime' },
                { data: 'prezime' },
                { data: 'imei' },
                { data: 'pk' },
                { data: 'promet_uzivo' },
                { data: 'pin' },
              
                { data: 'blokiran' }
           
                ]
    });
    urlDin = "{{ route('androidAppsForUser', ['korisnik' =>'n']) }}"
  var pravaNaApp = $('#pravaNaApp').DataTable({
     
        scrollY: "30vh",
        paging: false,
        scrollX: true,
        select:true,
        //"deferLoading": 0,
        searching:false,
        ajax:{
            url:  urlDin,
                "type": "GET",
                'data':{
                  //korisnik:'BOJAN'
                               },
                dataSrc: ''
            },
        columns:[
                { data: 'aplikacija' }
                
           
                ]
    });
         $("#selektovaniRed").hide();
      $(document).ready(function(){
            $('#tblKorisnici tbody').on('click','tr',function(event){
                selektovanoZaglavlje = $(this).find('td').eq($('#SIFRA_KLASE').index()).html();
                        if (pickedup != null) {
                              pickedup.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#17A2B8" );
                          pickedup = $( this );

                        urlDin = '{{ route('androidAppsForUser', ['korisnik' =>':korisnik']) }}';

                        urlDin = urlDin.replace(':korisnik', selektovanoZaglavlje);
                                    pravaNaApp.ajax.url(urlDin).load();
                          //pravaNaApp.ajax.reload();
                          $('#selektovaniRed').text($(this).find('td').eq(0).html());
                          $("#selektovaniRed").show();

                          $('#IMEI2').val($(this).find('td').eq(3).html());
                          $('#KORISNIK2').val($(this).find('td').eq(0).html());
                          $('#IME2').val($(this).find('td').eq(1).html());
                          $('#PREZIME2').val($(this).find('td').eq(2).html());
                          $('#PK2').val($(this).find('td').eq(4).html());
                          $('#PIN2').val($(this).find('td').eq(6).html());
                          $('#BLOKIRAN2').val($(this).find('td').eq(7).html());
                          $('#PROMET_UZIVO2').val($(this).find('td').eq(5).html());

                          $('#KORISNIK_PRAVO').val($(this).find('td').eq(0).html());

                            popuniSelectUsera();
   
            });
             $('#pravaNaApp tbody').on('click','tr',function(event){

                appSaPRavom = $(this).find('td').eq(0).html();
                if (pickedup2 != null) {
                              pickedup2.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#17A2B8" );
                          pickedup2 = $( this );

             });
             
        });
      
           </script>
   

         
@stop
