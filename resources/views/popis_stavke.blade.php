@extends('layouts.admin_dash')
@section('page_heading','STAVKE POPISA')
@section('section')

<div class="container-fluid p-0">
	<div class="row">
		<div class="col-sm-auto col-12">
			<a type="button" class="btn btn-primary" href="{{ route('popisIndex',['sema'=>$sema,'tabela'=>'m_popis']) }}">
			  <i class="fas fa-arrow-left mr-2"></i>Nazad
			</a>
		</div>
		<div class="col-sm-6 col-12">
			
			<label class="border-left border-primary pl-2">Datum popisa: {{$popis_info->sis_datum}} </label>
			<label class="border-left border-primary pl-2">Objekat: {{$popis_info->nazobj}}  </label>
			<label class="border-left border-primary pl-2">Ukupno artikala: {{$popis_info->broj_artikala}}  </label>
			<label class="border-left border-primary pl-2" id="ajaxRefreshBrojPopisanih">Popisanih stavki: {{$popis_info->broj_popunjenih_artikala}} </label>
			
		
		</div>
		
	</div>
	<hr>
	<div class="row">
		
			 <div class="form-group  col-lg-3 col-sm-6 col-12">
			    <label for="filterStatus">Filter POPISANE/NEPOPISANE:</label>
			    <select class="form-control" id="filterStatus">
			    	<option value="SVE">SVE</option>
			    	<option value="NEPOPISANE">NEPOPISANE</option>
			    	<option value="POPISANE">POPISANE</option>
			    </select>
			 </div>
			 <div class="form-group  col-lg-2 col-sm-5 col-12">
			    <label for="filterStatus">Preuzimanje fajla za import</label>
			    <button class="pl-2 btn btn-success">Preuzmi</button>
			 </div>
			 {{-- <div class="">
			 	<span data-href="{{url('exportCsv',$popis_id)}}" id="export" class="btn btn-success btn-sm" >Export</span>
			 </div> --}}
			{{--  <div class="form-group  col-lg-2 col-sm-3 col-12">
			    <label for="filterStatus">Refresh tabele</label>
			    <button class="btn btn-success" id="osveziTabelu">Refresh</button>
			 </div> --}}
	</div>
	<div class="row">
		<div class="col-12">
			<table class="table table-striped table-bordered mojeTabele" style="width: 100%;"  id="tblPopisStavke">
				<thead>
					<th>SIFRA</th>
					<th>BARKOD</th>
					<th>NAZIV</th>
					<th>ZALIHA</th>
					<th>CENA</th>
					<th>VREDNOST</th>
					<th>POPIS</th>
					<th>VREDNOST<br> POPISA</th>
				</thead>
			</table>
		</div>
	</div>
</div>
<style> 
	.warning {
    background-color: #5985ff !important;

}
.table label {
	font-size: 15px;
	font-weight: bold;
}
.vl {
  border-left: 6px solid #5985ff;
}

</style>
<script>
	$(document).ready(function() {
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		$('#export').click(function(){
				let _url = $(this).data('href');
		      window.location.href = _url;	
		});
		// function exportTasks(_this) {
		//       let _url = $(_this).data('href');
		//       window.location.href = _url;
		//    }
		var tblPopisStavke = $('#tblPopisStavke').DataTable({
		                ordering:false,
		                scrollY: "50vh",
		                paging: false,
		                scrollX: true,
		                select:true,
		                searching:true,
		                ajax:{
		                    url:  "{{ route('spisakStavkiPopisa') }}",
		                        "type": "POST",
		                        "data": function(d){
		                        	d.popis_id = '{{$popis_id}}';
		                        	d.status_popisane = $('#filterStatus').val(); 
							      },
							      
							      error: function (xhr, error, code)
						            {
						            	//console.log(error);
						            	$.notify("Greska prilikom ucitavanja. Osvezite stranicu", { globalPosition: 'bottom right', className: 'error' });
						            },
						            "dataSrc": function ( json ) {
						                //Make your callback here.
						                return json;
						                tblPopisStavke.rows().every( function ( rowIdx, tableLoop, rowLoop ) {       
								        var cell = tblPopisStavke.cell({ row: rowIdx, column: 3 }).node();
								        $(cell).addClass('warning'); 
								        	});      
						                
						            }
		                    },
		                columns:[
		                         { data: 'sifra_artikla' },
		                         { data: 'barcode' },
		                         { data: 'naziv_artikla' },
		                         { data: 'kolicina_jmere' },
		                         { data: 'prodcen_din' },
		                         { data: 'vrednost_din' },
		                         { data: 'popisana_kolicina'   },
		                         { data: 'vrednost_popisa'  },
		                        ],
		                          columnDefs: [{
		                            data: null,
		                            defaultContent: "-",
		                            targets: "_all"
		                            }],
		                           columnDefs: [
								    { className: "warning", "targets": [ -1,-2 ] }
								  ]
		        });
		$('#osveziTabelu').click(function(){
			tblPopisStavke.ajax.reload();
		});
		$('#filterStatus').on('change',function(){
			tblPopisStavke.ajax.reload();
		});

							$(document ).on("focusout","#tblPopisStavke input.popisana_kolicina",function() {
					//$("#53976").css({"box-shadow":"0 0 10px #2eff46"});
							var id_stavke = $(this).data('id');
							var prodcen = $(this).data('prodcen');
							var sifra_artikla = $(this).data('sifra_artikla');
							var popisana_kolicina = $(this).val();
							if (!popisana_kolicina){
								return;
							}
							$.ajax({
								    type: 'POST',
								    url: '{{route('popisStavkaNovaKolicina')}}',
								    data: { 
								        'id_stavke': id_stavke,
								        'popisana_kolicina':popisana_kolicina,
								        'popis_id':'{{$popis_id}}'
								    },
								    success: function(msg){
								    	//console.log(msg);
								    	//tblPopisStavke.ajax.reload(null, false);

								    	$("#"+id_stavke).css({"box-shadow":"0 0 10px #2eff46"});
								    	$("#p"+id_stavke).text(popisana_kolicina*prodcen);
								    	refreshBrojPopunjenih();
								    	$.notify("Uneto: "+popisana_kolicina+" Sifra artikla: "+sifra_artikla, { globalPosition: 'bottom right', className: 'success' });
								    }
								});
				
				});
				function refreshBrojPopunjenih(){
					
					$.ajax({
					    type: 'POST',
					    url: '{{route('labelBrojPopisanihRefresh')}}',
					    data: { 
					        'popis_id': '{{$popis_id}}'
					    },
					    success: function(broj_popunjenih_artikala){
					    	$('#ajaxRefreshBrojPopisanih').text('Popisanih stavki: '+broj_popunjenih_artikala);
					    }
					});
				}
		});
</script>



@endsection