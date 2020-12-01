@extends('layouts.admin_dash')
@section('page_heading','POPISI')
@section('section')

<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kreiranjePopisa">
			  Započni novi popis
			</button>
		</div>
		
	</div>
	<hr>
	<div class="row">
		{{-- <div class="col-12"> --}}
			<div class="form-group  col-lg-3 col-sm-6 col-12">
			    <label for="filterOrgjed">Filter po objektu:</label>
			    <select class="form-control" id="filterOrgjed">
			    	@foreach($objekti as $objekat)
			       		<option value="{{$objekat->orgjed}}">{{$objekat->naziv}}</option>
			      	@endforeach
			      	<option value="SVI">SVI</option>
			    </select>
			 </div>
			 <div class="form-group  col-lg-3 col-sm-6 col-12">
			    <label for="filterStatus">Filter po statusu:</label>
			    <select class="form-control" id="filterStatus">
			    	<option value="KREIRAN">KREIRAN</option>
			    	<option value="ZAVRSEN">ZAVRSEN</option>
			    	<option value="SVI">SVI</option>
			    </select>
			 </div>
		 {{-- </div> --}}
	</div>
	<div class="row mt-3">
		<div class="col-12">
			<table class="table table-striped table-bordered mojeTabele" style="width: 100%;"  id="tblPopis">
				<thead>
					<th>ID</th>
					<th>DATUM POPISA</th>
					<th>OBJEKAT</th>
					<th>KORISNIK</th>
					<th>URADJENO/UKUPNO ARTIKALA</th>
					<th>STATUS</th>
					<th>AKCIJA</th>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="kreiranjePopisa" tabindex="-1" aria-labelledby="kreiranjePopisa" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kreiranje popisa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('popisKreiraj')}}" method="GET">
	      <div class="modal-body">
			  <div class="form-group">
			    <label for="exampleFormControlSelect1">Izaberite objekat</label>
			    <select class="form-control" id="exampleFormControlSelect1" name="orgjed">
			      @foreach($objekti as $objekat)
			       	<option value="{{$objekat->orgjed}}">{{$objekat->naziv}}</option>
			      @endforeach
			    </select>
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
	        <button type="submit" class="btn btn-primary">Kreiraj</button>
	      </div>
      	</form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalRefreshArtikala" tabindex="-1" aria-labelledby="modalRefreshArtikala" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upis artikala za popis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	      <div class="modal-body">
			<p>Na odabranom popisu nisu popunjeni artikli.</p>
			<p>Ovo se moze desiti ukoliko se u trenutku kreiranja popisa vrsi transfer sa servera.</p>
			<p>Molim Vas sacekajte 5 minuta pa kliknite na dugme "Osvezi artikle"</p>
			<p>Hvala&nbsp;</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
	        <button type="button" id="osvezi_artikle" class="btn btn-primary">Osvezi artikle</button>
	      </div>
      	
    </div>
  </div>
</div>
 @section('mojJs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.all.min.js"></script>
@stop

{{-- @if (Session::has('message'))
	<label>radi</label>
@else
<label>ne radi</label>
@endif --}}
<script>
	$(document).ready(function() {
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		var selektovani_id_popisa = '';

		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});
		$('#filterOrgjed,#filterStatus').on('change',function(){
			tblPopis.ajax.reload();
		});
		var tblPopis = $('#tblPopis').DataTable({
		                ordering:false,
		                scrollY: "50vh",
		                paging: false,
		                scrollX: true,
		                select:true,
		                searching:false,
		                ajax:{
		                    url:  "{{ route('spisakPopisa') }}",
		                        "type": "POST",
		                        "data": function(d){
							          d.orgjed = $('#filterOrgjed').val();
							          d.status = $('#filterStatus').val();
							      },
							      error: function (xhr, error, code)
						            {
						            	console.log(error);
						            	$.notify("Greska prilikom ucitavanja. Osvezite stranicu", { globalPosition: 'bottom right', className: 'error' });
						            },
		                        dataSrc: ''
		                    },
		                columns:[
		                        { data: 'id' },
		                        { data: 'sis_datum' },
		                         { data: 'nazobj' },
		                         { data: 'naziv_korisnika' },
		                         { data: 'popisanih' },
		                         { data: 'status' },
		                         { data: 'akcija',render: function ( data, type, row ) 
							            {
							                return '<div class="d-flex">' + row.akcija + row.akcija2 + row.obrisipopis + row.popuniartikle + row.preuzmifajl +'</div>';
							            }
						          },
		                        ],
		                          columnDefs: [{
		                            data: null,
		                            defaultContent: "-",
		                            targets: "_all"
		                            }]
		        });

				$(document ).on("click","#tblPopis button.nastaviPopis",function() {
							url = '{{url('popisStavkeIndex')}}'+'/'+$(this).data('id_popisa');
							window.location=url;
				
				});
				$(document ).on("click","#tblPopis button.modalRefreshArtikala",function() {
						selektovani_id_popisa = $(this).data('id_popisa');
							$('#modalRefreshArtikala').modal('toggle');
				
				});
				$(document ).on("click","#tblPopis button.preuzmiFajl",function() {
						selektovani_id_popisa = $(this).data('id_popisa');
		    			window.location.href = '{{url('exportCsv')}}/' + selektovani_id_popisa;	
				
				});
				$(document ).on("click","#tblPopis button.obrisiPopis",function() {
						selektovani_id_popisa = $(this).data('id_popisa');
						Swal.fire({
							  title: "Da li ste sigurni?",
							  text: "Program ce dozvoliti brisanje samo kreiranih popisa, onih za koje niste popisali ni jednu stavku!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#d33',
							  cancelButtonColor: '#3085d6',
							  confirmButtonText: 'Da, obrisi!'
							}).then((result) => {
							  if (result.value) {
							  	if (selektovani_id_popisa != ''){
									$.ajax({
									    type: 'POST',
									    url: '{{route('popisBrisanje')}}',
									    data: { 
									        'popis_id': selektovani_id_popisa
									    },
									    success: function(msg){
									    	//console.log(msg);
									       tblPopis.ajax.reload();
									    }
									});
								}
							  }
							});
						
				});
				$('#osvezi_artikle').click(function(){
					if (selektovani_id_popisa != ''){
						$.ajax({
						    type: 'POST',
						    url: '{{route('popisArtikliRefresh')}}',
						    data: { 
						        'popis_id': selektovani_id_popisa
						    },
						    success: function(msg){
						    	//console.log(msg);
						    $('#modalRefreshArtikala').modal('toggle');
						       tblPopis.ajax.reload();
						    }
						});
					}else{

					}
				});

				$(document ).on("click","#tblPopis button.zavrsiPopis",function() {
					selektovani_id_popisa = $(this).data('id_popisa');
				Swal.fire({
				  title: 'Da li ste sigurni?',
				  text: "Ovim potvrdjujete da je zavrsen popis svih artikala i otkljucavate mogucnost preuzimanje fajla za import popisa. Ovom akcijom se zavrsava popis. Molim Vas pre potvrde proverite popisane stavke!",
				  type: 'question',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Da, potvrdi!'
				}).then((result) => {
				  if (result.value) {
				  	$.ajax({
									    type: 'POST',
									    url: '{{route('popisZavrsi')}}',
									    data: { 
									        'popis_id': selektovani_id_popisa
									    },
									    success: function(msg){
									    	msg = JSON.parse(msg);
									    	if (msg.status){
									    		Swal.fire(msg.poruka,'','success');
									    		tblPopis.ajax.reload();

									    	}else{
									    		Swal.fire(msg.poruka,'','error');
									    	}
										}
									});
				    // Swal.fire(
				    //   'Deleted!',
				    //   'Your file has been deleted.',
				    //   'success'
				    // )
				  }
				})
		});

		});


</script>

@endsection

