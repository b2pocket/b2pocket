@extends('layouts.dashboard')
@section('page_heading','Setovanje bilansa stanja')

@section('section')



	<div class="row">
	    <div class="col-sm-12">
			<div class="panel panel-default">
					  
				<div class="panel-heading">
						<h3 class="panel-title">Pregled zaglavlje</h3>
					
				</div>
						
				<div class="panel-body">
							<table class="table table-bordered" style="width: 100%"  id="zaglavljeKonta">
							<thead >
								<tr>
									<th>KLASA_KONTA</th>
									<th>KATEGORIJA</th>
									<th>REDOSLED</th>
						
									<th id="SIFRA_KLASE">SIFRA_KLASE</th>
								
								</tr>
							</thead>
						</table>			
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-default">
					  
				<div class="panel-heading">
						<h3 class="panel-title">Pregled neklasifikovanih konta</h3>
					
				</div>
						
				<div class="panel-body">
							<table class="table"  id="tableNeklasifikovanih">
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
	
		<div class="col-sm-6">
			<div class="panel panel-default">
					  
				<div class="panel-heading">
						<h3 class="panel-title">Konta selektovane klase</h3>
					
				</div>
						
				<div class="panel-body">
							<table class="table table-bordered" style="table-layout: fixed;width: 100%;"  id="tableDetail">
							<thead >
								<tr>
									<th>KLASA</th>
									<th>SIFRA_KLASE</th>
									<th>KONTO NAZIV</th>
									<th id="KLAS_KONTO">KONTO</th>
								
								</tr>
							</thead>
							<tbody></tbody>		
						</table>			
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
     
        scrollY: "200px",
        paging: false,
        scrollX: true,
        select:true,
        searching:false,
        ajax:{
          	url:  "{{ route('zaglavljeKontaStanja') }}",
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
              
                { data: 'sifra_klase' }
           
                ]
    });

	var url = '{{ route('tableDetailStanja', ['klasaKonta' => '99999999']) }}';
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
                { data: 'klasa_konta' },
                { data: 'sifra_klase' },
                { data: 'nazivd' },
                { data: 'konto' }
                ]
    });
    var nek = "{{ route('neklasifikovanaKontaStanja') }}";
    var tableNeklasifikovanih = $('#tableNeklasifikovanih').DataTable({
     
        scrollY: "200px",
        scrollX: true,
        paging: false,
        select:true,
        searching:false,
        ajax:{
          	url:  nek,
          		"type": "GET",
          		data:function(){
          		
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
      
           </script>
   

         
@stop
