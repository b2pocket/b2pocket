@extends('layouts.admin_dash')
@section('page_heading','Setovanje bilansa uspeha')

@section('section')



	<div class="row text-center justify-content-start">
    <div class=" col-12 col-xs-12">
	
    			<div class="card text-center">
    					  
          				<div class="card-header" style="background-color: #7386D5;">
          						<h3 class="card-title">Pregled zaglavlje</h3>
          					
          				</div>
    						
          				<div class="card-body text-center">

                      
          							<table  class="table" style="width: 100%;table-layout: fixed;"   id="zaglavljeKonta">
          							<thead>

          								<tr>
          									<th>KLASA_KONTA</th>
          									<th >KATEGORIJA</th>
          									<th>REDOSLED</th>
          									<th>NADLEZNOST</th>
          									<th id="SIFRA_KLASE">SIFRA_KLASE</th>
          									<th>OPEX</th>

          								</tr>
          							</thead>
                      
          						</table>
                   
                 
          				</div>
    		    </div>

		</div>
	 </div>

	<div class="row  mt-1 justify-content-start">
    <div class="col-12 col-xs-12">
      <div class="row">
    		<div class="col-md-5 col-sm-12">
    			<div class="card text-center">
    					  
            <div class="card-header" style="background-color: #7386D5;">
                <h3 class="card-title">Pregled neklasifikovanih konta</h3>
              
            </div>

    						
    				<div class="card-body text-center">
    							<table class="table" style="width: 100%;"  id="tableNeklasifikovanih">
    							<thead >
    								<tr>
    									<th id="KONTO">KONTO</th>
    									<th>NAZIV</th>
    								</tr>
    							</thead>

    						</table>			
    				</div>
    			</div>

    		</div>
    		<div class="col-md-2 col-sm-12" style="text-align: center;">
    			<button class="btn btn-light btn-circle btn-lg border" style="width: 40%;" id="povezi"><i  class="fas fa-link"></i></button>
    			<button class="btn btn-light btn-circle btn-lg border" style="width: 40%;" id="obrisi"><i class="fas fa-unlink"></i></button>
    		</div>
    		    <div class="col-md-5 col-sm-12">
              			<div class="card text-center">
                                <div class="card-header" style="background-color: #7386D5;">
                                    <h3 class="card-title">Konta selektovane klase</h3>
                                  
                                </div>
                  						
                        				<div class="card-body text-center">
                        							<table class="table table-bordered" style="table-layout: fixed;width: 100%;"  id="tableDetail">
                        							<thead >
                        								<tr>
                        								  <th  style="min-width: 100px;" id="KLAS_KONTO">KONTO</th>
                        									<th width="80%" style="min-width: 200px;">KONTO NAZIV</th>
                        									
                        								
                        								</tr>
                        							</thead>
                        							<tbody></tbody>		
                        						</table>			
                        				</div>
              			</div>
		        </div>
</div>
  </div>
		
</div>

	<script>
	var pickedup ;
	var pickedup2 ;
	var selektovanoZaglavlje = '';
	var selektovaniNeklasifikovani = '';
	var klasifikovaniKonto = '';

	var zaglavljeKonta = $('#zaglavljeKonta').DataTable({
     
        scrollY: "150px",
      paging: false,
      "scrollX": true,
      "scrollCollapse": true,
     // scroller:       true,

        //select:true,
       // responsive: true,
       // fixedHeader: true,
        searching:false,
        ajax:{
          	url:  "{{ route('zaglavljeKonta') }}",
          		"type": "GET",
          		data:function(){
                  //id:1

            					},
            	dataSrc: ''
        	},
        columns:[
                { data: 'klasa_konta' },
                { data: 'kategorija' },
                { data: 'redosled' },
                { data: 'nadleznost' },
                { data: 'sifra_klase' },
                { data: 'opex' }
                ]
    });
  


	var url = '{{ route('tableDetail', ['klasaKonta' => '99999999']) }}';
    var tableDetail = $('#tableDetail').DataTable({
        //processing: true,
        //serverSide: true,
        scrollY: "200px",
        scrollX: true,
        paging: false,
        select:true,
        searching:false,



        ajax:{
          	url:  url,
          		type: "GET",
          		data:function(){
            					},
            	dataSrc: ''
        	},
        columns:[
                { data: 'konto' },
                { data: 'nazivd' }
                
                ]
    });
    var nek = "{{ route('neklasifikovanaKonta') }}";
    var tableNeklasifikovanih = $('#tableNeklasifikovanih').DataTable({
     
        scrollY: "200px",
        scrollX: true,
        paging: false,
        select:true,
        searching:false,
        ajax:{
          	url:  nek,
          		"type": "GET",
              dataSrc: function (json) {
                    var obj = JSON.parse(json);
                    console.log(obj);
                    console.log('usao');
                  //  return obj;
                 },
          
            	dataSrc: ''
        	},
        columns:[
                { data: 'konto' },
                { data: 'naziv' }
        
                ]
    });



      $(document).ready(function(){
            $('#zaglavljeKonta tbody').on('click','tr',function(event){
                selektovanoZaglavlje = $(this).find('td').eq($('#SIFRA_KLASE').index()).html();
                        if (pickedup != null) {
                              pickedup.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#696969" );
                          pickedup = $( this );
                         // alert(selektovanoZaglavlje);

                        url = '{{ route('tableDetail', ['klasaKonta' => ':sifra_klase']) }}';
						url = url.replace(':sifra_klase', selektovanoZaglavlje);
							
							tableDetail.ajax.url(url).load();
    	
   
            });
          	$('#tableNeklasifikovanih tbody').on('click','tr',function(event){
          			selektovaniNeklasifikovani = $(this).find('td').eq($('#KONTO').index()).html();
          			 if (pickedup2 != null) {
                              pickedup2.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#696969" );
                          pickedup2 = $( this );
          		 });
          	$('#tableDetail tbody').on('click','tr',function(event){
          			klasifikovaniKonto = $(this).find('td').eq($('#KLAS_KONTO').index()).html();
          			 if (pickedup2 != null) {
                              pickedup2.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#696969" );
                          pickedup2 = $( this );
          		 });
        });
          function validirajSelectovano(param1,param2){

      		if (param1=='')
      	{
      		alert('Niste selektovali klasu konta');
      		event.preventDefault();
      		return false;
      	}
      	 	if (param2=='')
      	{
      		alert('Niste selektovali konto');
      		event.preventDefault();
      		return false;
      	}
      };
      $('#povezi').click(function(){
    
      	var vrednost = validirajSelectovano(selektovanoZaglavlje,selektovaniNeklasifikovani);
      	if (vrednost == false)
      	{
      		return false;
      	}
     	$.get("klasifikujKonto",{
                selektovanoZaglavlje: selektovanoZaglavlje,
                selektovaniNeklasifikovani: selektovaniNeklasifikovani
             
            },function(result){
                // alert(result);
                //alert(url);
                       tableDetail.clear().draw();
                tableNeklasifikovanih.clear().draw();
                
                tableDetail.ajax.url(url).load();
                tableNeklasifikovanih.ajax.url(nek).load();
                //table2.ajax.reload();
          
            });
     	});
  
      $('#obrisi').click(function(){
      	
      	var vrednost = validirajSelectovano(selektovanoZaglavlje,klasifikovaniKonto);
      	if (vrednost == false)
      	{
      		return false;
      	}

     	$.get("obrisiKlasifikacijuKonta",{
                selektovanoZaglavlje: selektovanoZaglavlje,
                klasifikovaniKonto: klasifikovaniKonto
             
            },function(result){
                tableDetail.clear().draw();
                tableNeklasifikovanih.clear().draw();

                tableDetail.ajax.url(url).load();
                tableNeklasifikovanih.ajax.url(nek).load();
                //table2.ajax.reload();
          
            });
     	});
           </script>
   

         
@stop
