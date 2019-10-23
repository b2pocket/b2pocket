@extends('layouts.admin_dash')
@section('page_heading','Tenderi')

@section('section')
@section('mojCss')
    <link rel="stylesheet" href="{{ asset("css/tenderi.css") }}">
    <link rel="stylesheet" href="{{ asset("css/select2.min.css") }}">
    


    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css"> --}}
    {{-- <link href="{{ asset("css/jquery.flexdatalist.min.css") }}" rel="stylesheet" type="text/css"> --}}
@endsection

{{-- <div class="container-fluid"> --}}
    {{-- stavke konkurent POCETAK --}}
        <div class="row collapse" id="selektovaniTenderInfoCardKonk">
       
        <div class="col-md-3 col-sm-12 p-0">
                <div class="col-3 mb-2 pl-0">
                    <button class="btn btn-primary" style="background-color:#2A52C4; " id="vratiNaPocetakKonk">Nazad</button>
                </div>
                <div class="card">
                    <div class="card-header  text-white" style="background-color: #2A52C4;">
                        <h4 class="card-title " id="cardInfoTitleKonk">Sun Gone</h4>
                      </div>
                    <div class="card-body ">
                        
                        <p class="card-text text-dark" id="cardInfoDatumiKonk">Here are the top resources for all things related to the Sun.</p>
                        <p class="card-text text-dark" id="cardInfoVrednostTenderaKonk">Here are the top resources for all things related to the Sun.</p>
                        <p class="card-text text-dark" id="cardInfoValutaBrojDanaKonk">Here are the top resources for all things related to the Sun.</p>
                 
                    </div>
                </div>
             <form id="formaStavkeKonk">
                    
                        
                            <div class="form-group row col-md-12 my-0">
                                
                                    <label class="col-md-12" for="stavkeArtikalKonk">Artikal: </label>
                                    <select id="stavkeArtikalKonk" class="form-control col-md-12"  style="width:100%!important;max-width: 100%;" required>
                                        <option value="">Odabir artikla</option>
                                        @foreach ($artikli as $artikal)
                                                <option value="{{$artikal->sifra}}">{{$artikal->naziv}}</option>>
                                        @endforeach
                                    </select>
                                
                            </div>
                           {{--  <div class="form-group row col-md-12 my-0">
                                    <label class="col-md-12"   for="">Kolicina: </label>
                                    <input class="form-control text-dark col-md-12" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 188  && event.keyCode !== 109" type="number" id="stavkeKolicinaKonk" placeholder="kolicina" required/>
                            </div> --}}
                            
                        
                            <div class="form-group row col-md-12 my-0">
                                <label class="col-md-12" for="stavkeArtikalZ1Konk">Prvi zamenski artikal: </label>
                                <select id="stavkeArtikalZ1Konk" class="form-control col-md-12"  style="width:100%!important;max-width: 100%;" >
                                    <option value="">Odabir prvog zamenskog</option>
                                    @foreach ($artikli as $artikal)
                                            <option value="{{$artikal->sifra}}">{{$artikal->naziv}}</option>>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row col-md-12 my-0">
                                <label class="col-md-12" for="stavkeArtikalZ2Konk">Drugi zamenski artikal: </label>
                                <select id="stavkeArtikalZ2Konk" class="form-control col-md-12"  style="width:100%!important;max-width: 100%;" >
                                    <option value="">Odabir drugog zamenskog</option>
                                    @foreach ($artikli as $artikal)
                                            <option value="{{$artikal->sifra}}">{{$artikal->naziv}}</option>>
                                    @endforeach
                                </select>
                            </div>
                        
                    
                    <div class="form-inline   ml-1 mb-0 mt-2">
                       
                                <button type="button"  id="unosStavkiHelenaKonk" class="d-inline mr-2 col-auto mb-2 mb-md-0  btn btn-primary" ><i class="fa fa-plus mr-1" aria-hidden="true" ></i>Unos</button>
                                <button type="button" id="brisanjeStavkiHelenaKonk" class="d-inline btn btn-danger" ><i class="fa fa-trash mr-1" aria-hidden="true" ></i>Brisanje</button>


                       
                    </div>
                </form>


            
        </div>
        <div class="col-md-9 col-xs-12 col-sm-12">
                <div class="row ml-2">
                    <div>
                        <label>Ucesnik:</label>
                    </div>
                    <div class="ml-1">
                       {{-- <input class="form-control flexdatalist" id="tess" list="partneri" placeholder="lista partnera" data-min-length='0'> --}}
                            <select id="ucesniciStavke" class="form-control"  style="width:100%!important;">
                                {{-- <option value="SVI">Svi partneri</option> --}}
                                @foreach ($ucesnici as $ucesnik)
                                        <option value="{{$ucesnik->id}}">{{$ucesnik->naziv}}</option>>
                                @endforeach
                            </select>  
                    </div>
                </div>
              
                    <table class="table tabelaTender" id="tblTenderiStavkeKonk" style="width: 100%;">
                        <thead>
                           <th>Artikal</th>
                     
                           <th>Prodajna cena</th>
                           <th>Zamenski 1</th>
                           <th>Zamenski 2</th>
                        </thead>
                    </table>
              
            </div>
    </div>
    {{-- stavke konkurent KRAJ --}}


    {{-- stavke helene POCETAK--}}
    <div class="row collapse" id="selektovaniTenderInfoCard">
       
        <div class="col-md-3 col-sm-12 p-0">
                <div class="col-3 mb-2 pl-0">
                    <button class="btn btn-primary" style="background-color:#2A52C4; " id="vratiNaPocetak">Nazad</button>
                </div>
                <div class="card">
                    <div class="card-header  text-white" style="background-color: #2A52C4;">
                        <h4 class="card-title " id="cardInfoTitle">Sun Gone</h4>
                      </div>
                    <div class="card-body ">
                        
                        <p class="card-text text-dark" id="cardInfoDatumi">Here are the top resources for all things related to the Sun.</p>
                        <p class="card-text text-dark" id="cardInfoVrednostTendera">Here are the top resources for all things related to the Sun.</p>
                        <p class="card-text text-dark" id="cardInfoValutaBrojDana">Here are the top resources for all things related to the Sun.</p>
                 
                    </div>
                </div>
             <form id="formaStavke">
                    
                        
                            <div class="form-group row col-md-12 my-0">
                                
                                    <label class="col-md-12" for="stavkeArtikal">Artikal: </label>
                                    <select id="stavkeArtikal" class="form-control col-md-12"  style="width:100%!important;max-width: 100%;" required>
                                        <option value="">Odabir artikla</option>
                                        @foreach ($artikli as $artikal)
                                                <option value="{{$artikal->sifra}}">{{$artikal->naziv}}</option>>
                                        @endforeach
                                    </select>
                                
                            </div>
                            <div class="form-group row col-md-12 my-0">
                                    <label class="col-md-12"   for="">Kolicina: </label>
                                    <input class="form-control text-dark col-md-12" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 188  && event.keyCode !== 109" type="number" id="stavkeKolicina" placeholder="kolicina" required/>
                            </div>
                            <div class="form-group row col-md-12 my-0">
                                <label class="col-md-12" for="">Nabanva cena: </label>
                                <input class="form-control text-dark col-md-12" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 188  && event.keyCode !== 109" type="number" id="stavkeNabCena" placeholder="nabavna cena" required>
                            </div>
                           {{--  <div class="d-inline  col-md-2 col-6 p-1">
                                <input class="form-control text-dark" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 188  && event.keyCode !== 109" type="number" id="stavkeProdCena" placeholder="prodajna cena">
                            </div> --}}
                        
                            <div class="form-group row col-md-12 my-0">
                                <label class="col-md-12" for="stavkeArtikalZ1">Prvi zamenski artikal: </label>
                                <select id="stavkeArtikalZ1" class="form-control col-md-12"  style="width:100%!important;max-width: 100%;" >
                                    <option value="">Odabir prvog zamenskog</option>
                                    @foreach ($artikli as $artikal)
                                            <option value="{{$artikal->sifra}}">{{$artikal->naziv}}</option>>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row col-md-12 my-0">
                                <label class="col-md-12" for="stavkeArtikalZ2">Drugi zamenski artikal: </label>
                                <select id="stavkeArtikalZ2" class="form-control col-md-12"  style="width:100%!important;max-width: 100%;" >
                                    <option value="">Odabir drugog zamenskog</option>
                                    @foreach ($artikli as $artikal)
                                            <option value="{{$artikal->sifra}}">{{$artikal->naziv}}</option>>
                                    @endforeach
                                </select>
                            </div>
                        
                    
                    <div class="form-inline   ml-1 mb-0 mt-2">
                       
                                <button type="button"  id="unosStavkiHelena" class="d-inline mr-2 col-auto mb-2 mb-md-0  btn btn-primary" ><i class="fa fa-plus mr-1" aria-hidden="true" ></i>Unos</button>
                                <button type="button" id="brisanjeStavkiHelena" class="d-inline btn btn-danger" ><i class="fa fa-trash mr-1" aria-hidden="true" ></i>Brisanje</button>


                       
                    </div>
                </form>


            
        </div>
        <div class="col-md-9 col-xs-12 col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="progress" style="height: 50px;">
                          <div class="progress-bar" id="progresVrednostiTendera" role="progressbar" style="width: 25%;color:black;font-size: 16px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                </div>
                <table class="table tabelaTender" id="tblTenderiStavke" style="width: 100%;">
                    <thead>
                       <th>Artikal</th>
                       <th>Kolicina</th>
                       <th>Nabavna cena</th>
                       <th>Prodajna cena</th>
                       <th>Apsolutni ruc</th>
                       <th>Procentualni ruc</th>
                       <th>Zamenski 1</th>
                       <th>Zamenski 2</th>
                    </thead>
                </table>
            </div>
    </div>
    {{-- stavke helene KRAJ --}}


    <div class="collapse" id="tenderiPrelged">
        <div class="row mb-2">
            <div class="d-md-inline d-sm-block mr-2">
                <label>Filteri:</label>
            </div>
            <div class="mr-2">
               {{-- <input class="form-control flexdatalist" id="tess" list="partneri" placeholder="lista partnera" data-min-length='0'> --}}
                    <select id="partneri" class="form-control d-md-inline d-sm-block "  style="width:100%!important;">
                        <option value="SVI">Svi partneri</option>
                        @foreach ($partneri as $partner)
                                <option value="{{$partner->sifra}}">{{$partner->naziv}}</option>>
                        @endforeach
                    </select>  
            </div>
           
               {{-- <input class="form-control flexdatalist" id="tess" list="partneri" placeholder="lista partnera" data-min-length='0'> --}}
              
                    <select id="filterStatus" class="form-control d-md-inline d-sm-block col-2 text-gray-900"   style="width:100%!important;">
                        <option value="SVI">Svi tenderi</option>
                        <option value="UN">Kreirani tenderi</option>
                        <option value="P">Potvrdjeni tenderi</option>
                        <option value="Z">Zavrseni tenderi</option>
                    </select>  
        </div>
        <div class="row">
            <div class="col-md-10 col-xs-12">
                <table class="table tabelaTender" id="tblTenderi" style="width: 100%;">
                    <thead>
                       <th>Partner</th>
                       <th>Datum od</th>
                       <th>Datum do</th>
                       <th>Vrednost tendera</th>
                       <th>Valuta broj dana</th>
                       <th>Status</th>
                       <th>Dobitnik tendera</th>
                    </thead>
                </table>
            </div>
            <div id="responsiveButtons" class="col-md-2 col-xs-12">
          
                    <button id="modalUnosa" class="d-md-block d-xs-inline btn btn-primary mb-2  col-12" ><i class="fa fa-plus mr-1" aria-hidden="true" ></i>Kreiraj tender</button>
                <button id="modalIzmene" class="d-md-block d-xs-inline btn btn-warning mb-2 col-12"><i class="fa fa-edit mr-1" aria-hidden="true"></i>Izmeni podatke</button>
                <button id="obrisiTender" class="d-md-block d-xs-inline btn btn-danger mb-2  col-12"><i class="fa fa-trash mr-1" aria-hidden="true"></i>Obrisi tender</button>
                <button id="stavkeHelena" class="d-md-block d-xs-inline btn btn-success mb-2 col-12"><i class="fa fa-info mr-1" aria-hidden="true"></i>Stavke</button>
                <button id="stavkeKonkurent" class="d-md-block d-xs-inline btn btn-success  col-12"><i class="fa fa-info mr-1" aria-hidden="true"></i>Stavke konkurenta</button>
                <div class="card text-center d-none  d-md-block d-xs-inline col-12 p-0 mt-2" style="width: 18rem;">
                  <div class="card-body">
                    <h5 class="card-title">Potvrdjivanje tendera</h5>
                    <p class="card-text">Potvrditi tender nakon unosa stavki</p>
                    <button class="btn btn-primary" id="potvrdaTendera">Potvrdi</button>
                  </div>
                </div>
                <div class="card text-center d-none d-sm-block d-md-block d-xs-inline col-12 p-0 mt-2" style="width: 18rem;">
                  <div class="card-body">
                    <h5 class="card-title ">Zatvaranje tendera</h5>
                    <p class="card-text">Zatvaranje se vrsi nakon dodeljivanja dobitnika tendera</p>
                    <button class="btn btn-primary" id="zatvaranjeTendera">Zatvori</button>
                  </div>
                </div>
            </div>
           
                
            
        </div>
    </div>
    <div class="d-block d-sm-none">
            <div class="btn-floating-container ">
                <button class="btn-floating btn btn-primary btn-medium"><i class="fa fa-bullseye " aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-primary btn-sm">Small button</button>
                <button type="button" class="btn btn-secondary btn-sm">Small button</button>
            </div>
    </div>
     
{{-- </div> --}}

<div class="modal fade" id="modalZatvoriTender"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white" >
        <h5 class="modal-title" id="exampleModalLabel" >Zatvaranje tendera tendera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modalFormaZatvaranje">
            <div class="form-row mb-2">
               {{-- <input class="form-control flexdatalist" id="tess" list="partneri" placeholder="lista partnera" data-min-length='0'> --}}
               <label>Dobitnik tendera: </label>
                    <select id="modalZatvoriUcesnik" class="form-control d-md-inline d-sm-block"  style="width:100%!important;" required>
                        <option value="">Odabir dobitnika tendera</option>
                        @foreach ($ucesnici2 as $ucesnik)
                                <option value="{{$ucesnik->id}}">{{$ucesnik->naziv}}</option>>
                        @endforeach
                    </select> 
            </div>
            <div class="form-row mb-2">
                <label>Datum zatvaranja: </label>
                <input  class="form-control bg-white" type="text" id="tenderDatumZatvaranja" pattern="(0[1-9]|1[012]).(0[1-9]|1[0-9]|2[0-9]|3[01]).[0-9]{4}" required>
            </div>
           
        
        </form>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="button" id="zatvoriTender" class="btn btn-primary">Potvrdi</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKreirajIzmeniTender"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white" >
        <h5 class="modal-title" id="exampleModalLabel" >Kreiranje tendera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modalForma">
            <div class="form-row mb-2">
               {{-- <input class="form-control flexdatalist" id="tess" list="partneri" placeholder="lista partnera" data-min-length='0'> --}}
               <label>Partner: </label>
                    <select id="modalPartneri" class="form-control d-md-inline d-sm-block"  style="width:100%!important;" required>
                        <option value="">Odabir partnera</option>
                        @foreach ($partneri as $partner)
                                <option value="{{$partner->sifra}}">{{$partner->naziv}}</option>>
                        @endforeach
                    </select> 
            </div>
            <div class="form-row mb-2">
                <label>Datum od: </label>
                <input  class="form-control bg-white" type="text" id="tenderDatumOd" pattern="(0[1-9]|1[012]).(0[1-9]|1[0-9]|2[0-9]|3[01]).[0-9]{4}" required>
            </div>
            <div  class="form-row mb-2">
                        <label>Datum do: </label>
                        <input class="form-control bg-white" type="text" id="tenderDatumDo" pattern="(0[1-9]|1[012]).(0[1-9]|1[0-9]|2[0-9]|3[01]).[0-9]{4}" required>
            </div>
            <div  class="form-row mb-2">
                        <label>Vrednost tendera: </label>
                        <input class="form-control text-dark" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 188  && event.keyCode !== 109" type="number" step="any" id="tenderVrednost" required>
            </div>
            <div  class="form-row mb-2">
                        <label>Valuta broj dana: </label>
                        <input class="form-control" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 188  && event.keyCode !== 109" type="number" id="tenderValutaBrojDana" required>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="button" id="kreirajTender" class="btn btn-primary">Kreiraj</button>
        <button type="button" id="izmeniTender" class="btn btn-primary">Izmeni</button>
      </div>
    </div>
  </div>
</div>

 @section('mojJs')
    <script src="{{ asset("js/select2.full.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    {{-- <script src="{{ asset("js/bootstrap-select.js") }}"></script> --}}
    {{-- <script src="{{ asset("js/jquery.flexdatalist.min.js") }}"></script> --}}
@stop
<script>
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
$('#tenderiPrelged').collapse();
$("#partneri").select2( {
 placeholder: "Odabir partnera",
 allowClear: true,
 width: 'resolve',
 dropdownCssClass : 'bigdrop'
 } );
$("#modalPartneri").select2( {
 placeholder: "Odabir partnera",
 allowClear: true,
 width: 'resolve',
 dropdownCssClass : 'bigdrop'
 } );
$("#stavkeArtikal,#stavkeArtikalKonk").select2( {
 placeholder: "Odabir artikla",
 allowClear: true,
 width: 'element',
 dropdownCssClass : 'bigdrop'
 } );
var tblTenderi = $('#tblTenderi').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:true,
                ajax:{
                    url:  '{{url('tenderiPrelged')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}',
                        "type": "GET",
                        data:function(d){
                                    d.status = $('#filterStatus').val();
                                    d.partner = $('#partneri').val();
                            
                                       },
                        "dataSrc": function (response) { 
                                        if(response.whaterver == 0){
                                           //DO YOUR THING HERE
                                        }
                                       // console.log(response);
                                        return response; 
                                       }
                    },

                columns:[
                        { data: 'naziv_partnera' },
                        { data: 'datum_od' },
                        { data: 'datum_do' },
                        { data: 'vrednost_tendera_sep' },
                        { data: 'valuta_broj_dana' },
                        { data: 'status' },
                        { data: 'naziv_dobitnika' }                  
                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });
var tblTenderiStavke = $('#tblTenderiStavke').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:true,
                "deferLoading": 0, // here
                ajax:{
                    url:  '{{url('tenderiPrelgedStavke')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}',
                        "type": "GET",
                        data:function(d){
                            if (selektovani_podaci)
                             {
                                d.id = selektovani_podaci.id;
                             }
                                        
                               
                            
                                       },
                        "dataSrc": function (response) { 
                                        if(response.whaterver == 0){
                                           //DO YOUR THING HERE
                                        }
                                        
                                        //var stavkePodaci = JSON.parse(response);
                                        //console.log(response);
                                        var duzina = response.length;
                                        var ukupnaProdajnaCena=0;
                                        var procenat = 0;
                                        if (selektovani_podaci)
                                        {
                                            var vrednost_tendera = selektovani_podaci.vrednost_tendera;
                                            if (duzina)
                                            {
                                                for (i = 0; i < response.length; i++) 
                                                {  //loop through the array
                                                        if (response[i].prod_cena)
                                                        {
                                                            ukupnaProdajnaCena += parseInt(response[i].prod_cena)*parseInt(response[i].kolicina);  //Do the math!
                                                        }
                                                        
                                                }

                                                
                                                console.log(vrednost_tendera+', a vrednost uneta je '+ukupnaProdajnaCena);
                                                // alert(Math.floor((parseInt(ukupnaProdajnaCena)/parseInt(vrednost_tendera))*100)); //w00t!
                                                var procenat = Math.floor((parseInt(ukupnaProdajnaCena)/parseInt(vrednost_tendera))*100);
                                                $('#progresVrednostiTendera').text(ukupnaProdajnaCena+'('+procenat+'%) od '+selektovani_podaci.vrednost_tendera_sep);
                                                $('#progresVrednostiTendera').width(procenat+'%');
                                            }
                                            else
                                            {
                                                $('#progresVrednostiTendera').text(ukupnaProdajnaCena+'('+procenat+'%) od '+selektovani_podaci.vrednost_tendera_sep);
                                                $('#progresVrednostiTendera').width(procenat+'%');
                                            }
                                        }

                                        return response; 
                                       }
                    },

                columns:[
                        { data: 'naziv' },
                        { data: 'kolicina' },
                        { data: 'nab_cena' },
                        { data: 'prodajna_vred' },
                        { data: 'abs_ruc' },
                        { data: 'proc_ruc' },
                        { data: 'naziv_z1' },
                        { data: 'naziv_z2' }
                                         
                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });
var tblTenderiStavkeKonk = $('#tblTenderiStavkeKonk').DataTable({
                ordering:false,
                scrollY: "50vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:true,
                "deferLoading": 0, // here
                ajax:{
                    url:  '{{url('tenderiPrelgedStavkeKonk')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}',
                        "type": "GET",
                        data:function(d){
                            if (selektovani_podaci)
                             {
                                d.id = selektovani_podaci.id;
                                d.ucesnik = $('#ucesniciStavke').val();
                             }
                                        
                               
                            
                                       },
                        "dataSrc": function (response) { 
                                        if(response.whaterver == 0){
                                           //DO YOUR THING HERE
                                        }
                                        
                                        //var stavkePodaci = JSON.parse(response);
                                        //console.log(response);
                                        // var duzina = response.length;
                                        // var ukupnaProdajnaCena=0;
                                        // var procenat = 0;
                                        // if (selektovani_podaci)
                                        // {
                                        //     var vrednost_tendera = selektovani_podaci.vrednost_tendera;
                                        //     if (duzina)
                                        //     {
                                        //         for (i = 0; i < response.length; i++) 
                                        //         {  //loop through the array
                                        //                 if (response[i].prod_cena)
                                        //                 {
                                        //                     ukupnaProdajnaCena += parseInt(response[i].prod_cena)*parseInt(response[i].kolicina);  //Do the math!
                                        //                 }
                                                        
                                        //         }

                                                
                                        //         console.log(vrednost_tendera+', a vrednost uneta je '+ukupnaProdajnaCena);
                                        //         // alert(Math.floor((parseInt(ukupnaProdajnaCena)/parseInt(vrednost_tendera))*100)); //w00t!
                                        //         var procenat = Math.floor((parseInt(ukupnaProdajnaCena)/parseInt(vrednost_tendera))*100);
                                        //         $('#progresVrednostiTenderaKonk').text(ukupnaProdajnaCena+'('+procenat+'%) od '+selektovani_podaci.vrednost_tendera_sep);
                                        //         $('#progresVrednostiTenderaKonk').width(procenat+'%');
                                        //     }
                                        //     else
                                        //     {
                                        //         $('#progresVrednostiTenderaKonk').text(ukupnaProdajnaCena+'('+procenat+'%) od '+selektovani_podaci.vrednost_tendera_sep);
                                        //         $('#progresVrednostiTenderaKonk').width(procenat+'%');
                                        //     }
                                        // }

                                        return response; 
                                       }
                    },

                columns:[
                        { data: 'naziv' },

                        { data: 'prodajna_vred' },
                 
                        { data: 'naziv_z1' },
                        { data: 'naziv_z2' }
                                         
                        ],
                          columnDefs: [{
                            data: null,
                            defaultContent: "-",
                            targets: "_all"
                            }]
        });

$('#filterStatus,#partneri').change(function(){
    tblTenderi.ajax.reload();
});

var selektovani_podaci;
var selektovani_podaci_stavke;
var selektovani_podaci_stavke_konk;
$('#tblTenderi tbody').on('click','tr',function(event){

         selektovani_podaci =tblTenderi.row(this).data();
         //console.log(selektovani_podaci);
        $('#cardInfoTitle').text('Partner: '+selektovani_podaci.naziv_partnera);
        $('#cardInfoDatumi').text('Datum od: '+selektovani_podaci.datum_od+' do '+selektovani_podaci.datum_do);
        $('#cardInfoVrednostTendera').text('Vrednost tendera: '+selektovani_podaci.vrednost_tendera_sep);
        $('#cardInfoValutaBrojDana').text('Valuta broj dana: '+selektovani_podaci.valuta_broj_dana);

        $('#cardInfoTitleKonk').text('Partner: '+selektovani_podaci.naziv_partnera);
        $('#cardInfoDatumiKonk').text('Datum od: '+selektovani_podaci.datum_od+' do '+selektovani_podaci.datum_do);
        $('#cardInfoVrednostTenderaKonk').text('Vrednost tendera: '+selektovani_podaci.vrednost_tendera_sep);
        $('#cardInfoValutaBrojDanaKonk').text('Valuta broj dana: '+selektovani_podaci.valuta_broj_dana);
        //$('#selektovaniTenderInfoCard').collapse('toggle');
        //$('#tenderiPrelged').collapse('toggle');
});
$('#tblTenderiStavke tbody').on('click','tr',function(event){

         selektovani_podaci_stavke =tblTenderiStavke.row(this).data();
     
});
$('#tblTenderiStavkeKonk tbody').on('click','tr',function(event){

         selektovani_podaci_stavke_konk =tblTenderiStavkeKonk.row(this).data();
     
});
$('#vratiNaPocetak').click(function(){
    $('#selektovaniTenderInfoCard').collapse('toggle');
        $('#tenderiPrelged').collapse('toggle');
});
$('#vratiNaPocetakKonk').click(function(){
    $('#selektovaniTenderInfoCardKonk').collapse('toggle');
        $('#tenderiPrelged').collapse('toggle');
});

var $window = $(window);
 if ($window.width() < 768) {
      //return $html.addClass('xs');
      $('#responsiveButtons').addClass('btn-floating-container');
    }
    else if ($window.width() > 768 && $window.width() < 992) {
     // return $html.addClass('sm');
    }
    else if ($window.width() > 992 && $window.width() < 1200) {
    //  return $html.addClass('md');
    }
    else if ($window.width() > 1200) {
      //return $html.addClass('lg');
    }

$('#kreirajTender').click(function(){
    // $('#modalForma').submit(function(e){
    //   e.preventDefault();
    // });
    // alert('dd');
        var $myForm = $('#modalForma');
       // alert('s');
        if(! $myForm[0].checkValidity()) {
          // If the form is invalid, submit it. The form won't actually submit;
          // this will just cause the browser to display the native HTML5 error messages.
          $('<input type="submit">').hide().appendTo($myForm).click().remove();
          $myForm.find(':submit').click();
           return false;
        }
        var url = '{{url('tenderUnos')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';;
                        $.post(url,{

                            partner:$('#modalPartneri').val(),
                            datum_od:$('#tenderDatumOd').val(),
                            datum_do:$('#tenderDatumDo').val(),
                            vrednost_tendera:$('#tenderVrednost').val(),
                            valuta_broj_dana:$('#tenderValutaBrojDana').val()
            
                            },function(result){
                                $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                //console.log(result);

                            tblTenderi.ajax.reload();
                            $('#filterStatus').val('UN').trigger('change');
                            $('#modalKreirajIzmeniTender').modal('toggle');
                        });

});

$('#modalIzmene').click(function(){
    if(!selektovani_podaci)
    {
         Swal.fire({
              type: 'error',
              title: 'Selektujte tender za izmenu!'
            });
         return false;
    }
    if(selektovani_podaci.status == 'Z')
    {
         Swal.fire({
              type: 'error',
              title: 'Ne mozete menjati zatvorene tendere!'
            });
         return false;
    }
    $('#modalPartneri').val(selektovani_podaci.komitent).trigger("change");
    $('#tenderDatumOd').val(selektovani_podaci.datum_od);
    $('#tenderDatumDo').val(selektovani_podaci.datum_do);
    $('#tenderVrednost').val(selektovani_podaci.vrednost_tendera);
    $('#tenderValutaBrojDana').val(selektovani_podaci.valuta_broj_dana);

    $('#exampleModalLabel').text('Izmena tendera');
    $('#kreirajTender').hide();
    $('#izmeniTender').show();
    $('#modalKreirajIzmeniTender').modal('toggle');

});
$('#zatvaranjeTendera').click(function(){
    if(!selektovani_podaci)
    {
         Swal.fire({
              type: 'error',
              title: 'Selektujte tender za zatvaranje!'
            });
         return false;
    }
    if(selektovani_podaci.status != 'P')
    {
         Swal.fire({
              type: 'error',
              title: 'Samo tendere u statusu potvrdjeni tenderi mozete zatvoriti!'
            });
         return false;
    }

    $('#modalZatvoriTender').modal('toggle');

});


$('#modalUnosa').click(function(){

    $('#modalPartneri').val("").trigger("change");
    $('#tenderDatumOd').val('');
    $('#tenderDatumDo').val('');
    $('#tenderVrednost').val('');
    $('#tenderValutaBrojDana').val('');

    $('#exampleModalLabel').text('Kreiranje tendera');
    $('#kreirajTender').show();
    $('#izmeniTender').hide();
    $('#modalKreirajIzmeniTender').modal('toggle');

});
$('#izmeniTender').click(function(){
       var $myForm = $('#modalForma');
        if(! $myForm[0].checkValidity()) {
          $('<input type="submit">').hide().appendTo($myForm).click().remove();
          $myForm.find(':submit').click();
           return false;
        }
        if (selektovani_podaci.status != 'UN')
        {
            Swal.fire({
              type: 'error',
              title: 'Nemoguca izmena',
              text: 'Mozete menjati samo nepotvrdjene tendere!'
            })
            return false;
        }
        var url = '{{url('tenderIzmena')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';
                        $.post(url,{
                            id: selektovani_podaci.id,
                            partner:$('#modalPartneri').val(),
                            datum_od:$('#tenderDatumOd').val(),
                            datum_do:$('#tenderDatumDo').val(),
                            vrednost_tendera:$('#tenderVrednost').val(),
                            valuta_broj_dana:$('#tenderValutaBrojDana').val()
            
                            },function(result){
                                $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                // console.log(result);
                            tblTenderi.ajax.reload();
                            $('#modalKreirajIzmeniTender').modal('toggle');
                        });
      });

$('#zatvoriTender').click(function(){
       var $myForm = $('#modalFormaZatvaranje');
        if(! $myForm[0].checkValidity()) {
          $('<input type="submit">').hide().appendTo($myForm).click().remove();
          $myForm.find(':submit').click();
           return false;
        }
        if (selektovani_podaci.status != 'P')
        {
            Swal.fire({
              type: 'error',
              title: 'Nemoguca izmena',
              text: 'Mozete zatvoriti samo potvrdjene tendere!'
            })
            return false;
        }
        var url = '{{url('tenderZatvaranje')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';
                        $.post(url,{
                            id: selektovani_podaci.id,
                            ucesnik:$('#modalZatvoriUcesnik').val(),
                            datum:$('#tenderDatumZatvaranja').val()
                            
            
                            },function(result){
                                $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                // console.log(result);
                            tblTenderi.ajax.reload();
                            $('#filterStatus').val('Z').trigger('change');
                            $('#modalZatvoriTender').modal('toggle');
                        });
      });
$('#obrisiTender').click(function(){
       if(!selektovani_podaci)
    {
         Swal.fire({
              type: 'error',
              title: 'Selektujte tender za brisanje!'
            });
         return false;
    }
    Swal.fire({
          title: 'Da li ste sigurni?',
          text: "Trajno ce biti obrisan!",
          type: 'warning',
          showCancelButton: true,
          cancelButtonText: 'odustani',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Da, obrisi!'
        }).then((result) => {
          if (result.value) {

                    var url = '{{url('tenderBrisanje')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';
                    $.post(url,{
                            id: selektovani_podaci.id,
                            },function(result){
                               $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                // console.log(result);
                            tblTenderi.ajax.reload();
                            //$('#modalKreirajIzmeniTender').modal('toggle');
                        });

                        
          }
        })

});
$('#potvrdaTendera').click(function(){
       if(!selektovani_podaci)
    {
         Swal.fire({
              type: 'error',
              title: 'Selektujte tender za potvrdu!'
            });
         return false;
    }
    if(selektovani_podaci.status != 'UN')
    {
         Swal.fire({
              type: 'error',
              title: 'Samo tendere u statusu "Kreirani tenderi mozete potvrditi"!'
            });
         return false;
    }
    Swal.fire({
          title: 'Da li ste sigurni?',
          text: "Nakon potvrde ne moze se raditi nad stavkama dokumenta!",
          type: 'warning',
          showCancelButton: true,
          cancelButtonText: 'odustani',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Da, obrisi!'
        }).then((result) => {
          if (result.value) {

                    var url = '{{url('tenderPotvrda')}}'+'/{!!$sema!!}'+'/{!!$tabela!!}';
                    $.post(url,{
                            id: selektovani_podaci.id,
                            },function(result){
                               $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                // console.log(result);
                            tblTenderi.ajax.reload();
                            $('#filterStatus').val('P').trigger('change');
                            //$('#modalKreirajIzmeniTender').modal('toggle');
                        });

                        
          }
        })

});

$('#stavkeHelena').click(function(){
    if(!selektovani_podaci)
    {
         Swal.fire({
              type: 'error',
              title: 'Selektujte tender!'
            });
         return false;
    }
    if(selektovani_podaci.status != 'UN')
    {
       Swal.fire({
              type: 'error',
              title: 'Samo u statusu kreirani tenderi mozete unositi stavke!'
            });
         return false; 
    }
    tblTenderiStavke.ajax.reload();
    $('#selektovaniTenderInfoCard').collapse('toggle');
        $('#tenderiPrelged').collapse('toggle');
});
$('#stavkeKonkurent').click(function(){
    if(!selektovani_podaci)
    {
         Swal.fire({
              type: 'error',
              title: 'Selektujte tender!'
            });
         return false;
    }
    if(selektovani_podaci.status != 'UN')
    {
       Swal.fire({
              type: 'error',
              title: 'Samo u statusu kreirani tenderi mozete unositi stavke!'
            });
         return false; 
    }
    tblTenderiStavkeKonk.ajax.reload();
    $('#selektovaniTenderInfoCardKonk').collapse('toggle');
        $('#tenderiPrelged').collapse('toggle');
});
$('#unosStavkiHelena').click(function(){
        var $myForm = $('#formaStavke');
        if(! $myForm[0].checkValidity()) {     
          $('<input type="submit">').hide().appendTo($myForm).click().remove();
          $myForm.find(':submit').click();
           return false;
        }
        var url = '{{url('tenderUnosStavki')}}'+'/{!!$sema!!}'+'/tenderi_stavke';;
                        $.post(url,{

                            tender:selektovani_podaci.id,
                            artikal:$('#stavkeArtikal').val(),
                            kolicina:$('#stavkeKolicina').val(),
                            nab_cena:$('#stavkeNabCena').val(),
                            // prod_cena:$('#stavkeProdCena').val(),
                            artikal_z1:$('#stavkeArtikalZ1').val(),
                            artikal_z2:$('#stavkeArtikalZ2').val()
            
                            },function(result){
                                $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                //console.log(result);

                            tblTenderiStavke.ajax.reload();
                          
                        });
});
$('#unosStavkiHelenaKonk').click(function(){
        var $myForm = $('#formaStavkeKonk');
        if(! $myForm[0].checkValidity()) {     
          $('<input type="submit">').hide().appendTo($myForm).click().remove();
          $myForm.find(':submit').click();
           return false;
        }
        var url = '{{url('tenderUnosStavkiKonk')}}'+'/{!!$sema!!}'+'/tenderi_stavke_ucesnici';;
                        $.post(url,{

                            tender:selektovani_podaci.id,
                            artikal:$('#stavkeArtikalKonk').val(),
                            ucesnik:$('#ucesniciStavke').val(),
                            artikal_z1:$('#stavkeArtikalZ1Konk').val(),
                            artikal_z2:$('#stavkeArtikalZ2Konk').val()
            
                            },function(result){
                                $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                //console.log(result);

                            tblTenderiStavkeKonk.ajax.reload();
                          
                        });
});
$('#brisanjeStavkiHelena').click(function(){
       if(!selektovani_podaci_stavke)
    {
         Swal.fire({
              type: 'error',
              title: 'Selektujte artikal za brisanje!'
            });
         return false;
    }
    Swal.fire({
          title: 'Da li ste sigurni?',
          text: "Trajno ce biti obrisan!",
          type: 'warning',
          showCancelButton: true,
          cancelButtonText: 'odustani',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Da, obrisi!'
        }).then((result) => {
          if (result.value) {

                    var url = '{{url('tenderStavkaBrisanje')}}'+'/{!!$sema!!}'+'/tenderi_stavke';
                    $.post(url,{
                            id: selektovani_podaci_stavke.id,
                            },function(result){
                               $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                // console.log(result);

                            tblTenderiStavke.ajax.reload();
                            //$('#modalKreirajIzmeniTender').modal('toggle');
                        });

                        
          }
        })

});
$('#brisanjeStavkiHelenaKonk').click(function(){
       if(!selektovani_podaci_stavke_konk)
    {
         Swal.fire({
              type: 'error',
              title: 'Selektujte artikal za brisanje!'
            });
         return false;
    }
    Swal.fire({
          title: 'Da li ste sigurni?',
          text: "Trajno ce biti obrisan!",
          type: 'warning',
          showCancelButton: true,
          cancelButtonText: 'odustani',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Da, obrisi!'
        }).then((result) => {
          if (result.value) {

                    var url = '{{url('tenderStavkaBrisanje')}}'+'/{!!$sema!!}'+'/tenderi_stavke_ucesnici';
                    $.post(url,{
                            id: selektovani_podaci_stavke_konk.id,
                            },function(result){
                               $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                // console.log(result);

                            tblTenderiStavkeKonk.ajax.reload();
                            //$('#modalKreirajIzmeniTender').modal('toggle');
                        });

                        
          }
        })

});
$("#tblTenderiStavke").on("focusout","#unosProdajneStavke",function(event){
               
                      //  alert($(this).val());
                      // alert(selektovani_podaci_stavke.id);
        var url = '{{url('tenderUnosProdajneCene')}}'+'/{!!$sema!!}'+'/tenderi_stavke';;
                        $.post(url,{

                            id : selektovani_podaci_stavke.id,
                            cena : $(this).val()
                            },function(result){
                                $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                //console.log(result);

                            tblTenderiStavke.ajax.reload(null, false);
                          
                        });

    });
$("#tblTenderiStavkeKonk").on("focusout","#unosProdajneStavkeKonk",function(event){
               
                      //  alert($(this).val());
                      // alert(selektovani_podaci_stavke.id);
        var url = '{{url('tenderUnosProdajneCene')}}'+'/{!!$sema!!}'+'/tenderi_stavke_ucesnici';;
                        $.post(url,{

                            id : selektovani_podaci_stavke_konk.id,
                            cena : $(this).val()
                            },function(result){
                                $.notify( result['greska'],
                                    {
                                        className: result['klasa'],
                                        globalPosition: 'bottom right'
                                    });
                                //console.log(result);

                            tblTenderiStavkeKonk.ajax.reload(null, false);
                          
                        });

    });


$("#tenderDatumOd, #tenderDatumDo,#tenderDatumZatvaranja").datepicker({ onSelect: function () {  },

                 monthNamesShort: [ "Januar", "Februar", "Mart", "April", "Maj", "Juni", "Juli", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar" ],
        dayNamesMin: ['Ned', 'Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub'],
        dateFormat: "mm.dd.yy",
        yearRange: '1910:2025',
        firstDay: 1,    
        numberOfMonths: 1,
             changeMonth: true, changeYear: true });



</script>
<script>
    // $('#tess').change(function(){
    //     alert($('#partneri').attr('value'));
    // });


</script>
@endsection
