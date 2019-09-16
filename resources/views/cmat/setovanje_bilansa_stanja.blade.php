@extends('layouts.admin_dash')
@section('page_heading','Setovanje bilansa stanja')

@section('section')

<div class="container-fluid">
<div class="row col-12 form-group">
  <label class="mr-2">Firma:</label>
  <select class="form-control col-2 mb-1" id="firma">

          @foreach ($firme as $firma)
            <option value="{{$firma->id}}">{{$firma->naziv}}</option>
            @endforeach
    </select>
</div>
<div class="row">
    	<div class="col-sm-12 col-xs-12">
    	   
    			<div class="card card-default">
    					  
    				<div class="card-header" style="background-color: #2850C3;">
    						<h3 class="card-title" class="m_responsive_header">Pregled zaglavlje</h3>
    					
    				</div>
    						
    				<div class="card-body">
    							<table class="table" style="width: 100%;"  id="zaglavljeKonta">
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
    	<div class="row col-12">
    		<div class="col-md-6 col-xs-12">
    			<div class="card card-default">
    					  
    				<div class="card-header" style="background-color: #2850C3;">
    						<h3 class="card-title">Pregled neklasifikovanih konta</h3>
    					
    				</div>
    						
    				<div class="card-body">
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
    	
    		<div class="col-md-6 col-xs-12">
    			<div class="card card-default">
    					  
    				<div class="card-header" style="background-color: #2850C3;">
    						<h3 class="card-title">Konta selektovane klase</h3>
    					
    				</div>
    						
    				<div class="card-body">
    							<table class="table table-bordered" style="table-layout: fixed;width: 100%;"  id="tableDetail">
    							<thead >
    								<tr>
    									 <th width="150px" id="KLAS_KONTO">KONTO</th>
    									<th width="150px">KONTO NAZIV</th>
    								
    								
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
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
	var pickedup ;
	var pickedup2 ;
	var selektovanoZaglavlje = '';
	var selektovaniNeklasifikovani = '';
	var klasifikovaniKonto = '';
	var zaglavljeKonta = $('#zaglavljeKonta').DataTable({
     
        scrollY: "200px",
        paging: false,
        scrollX: true,
        "processing": true,
        select:true,
        searching:false,
        ajax:{
          	url:  "{{ route('zaglavljeKontaStanja') }}",
          		"type": "GET",
          		data:function(d){
                  d.sema = $('#firma').val();
            					},
            	"dataSrc": function ( json ) {
                   //console.log(json);
                   return json;
              }
        	},
        columns:[
                { data: 'klasa_konta' },
                { data: 'kategorija' },
                { data: 'redosled' },
              
                { data: 'sifra_klase' }
           
                ]
    });


	var url = '{{ route('tableDetailStanja') }}';
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
          		data:function(d){
                //alert($('#firma').val()+'---'+selektovanoZaglavlje);
                d.sema = $('#firma').val();
                d.klasaKonta = selektovanoZaglavlje;
            					},
            	"dataSrc": function ( json ) {
                  //console.log(json+'\n'+url);
                   return json;
              }
        	},
        columns:[
                { data: 'konto' },
                { data: 'nazivd' }
                
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
          		data:function(d){
                
                    d.sema = $('#firma').val();
            					},
            	dataSrc: ''
        	},
        columns:[
                { data: 'konto' },
                { data: 'naziv' }
        
                ]
    });
  $('#firma').change(function(){
    selektovanoZaglavlje = '';
    zaglavljeKonta.ajax.reload();
    tableDetail.ajax.reload();
    tableNeklasifikovanih.ajax.reload();
  })


      $(document).ready(function(){
            $('#zaglavljeKonta tbody').on('click','tr',function(event){
                selektovanoZaglavlje = $(this).find('td').eq($('#SIFRA_KLASE').index()).html();
                        if (pickedup != null) {
                              pickedup.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#696969" );
                          pickedup = $( this );
                         // alert(selektovanoZaglavlje);

                        url = '{{ route('tableDetailStanja', ['klasaKonta2' => ':sifra_klase']) }}';
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
