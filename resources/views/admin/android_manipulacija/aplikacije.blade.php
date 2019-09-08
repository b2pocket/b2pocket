@extends('layouts.admin_dash')
@section('page_heading','Android manipulacija')

@section('section')
    
<div class="container-fluid">
<div class="row">
    {{-- Tabela za menije --}}
            <div class="doleZalepljen">
                <button class="btn btn-success" id="prikaziSetMenija">MENIJI</button>
                <label id="prikaziSetMenijaTekst"></label>
                <button class="btn btn-success" id="prikaziSetAplikacija">APLIKACIJE</button>
                <label id="prikaziSetAplikacijaTekst"></label>
                <button class="btn btn-success" id="prikaziSetTabova">TABOVI</button>
                <label id="prikaziSetTabovaTekst"></label>
                <button class="btn btn-success" id="prikaziSetStavki">STAVKE</button>
                <label id="prikaziSetStavkiTekst"></label>
            </div>
            <div class="col-sm-5 col-xs-12 p-1" id="prvi">
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
                            <h3 style="float: right;" class="card-title karticaNaziv" class="m_responsive_header">Meniji</h3>
                            <div class="btn-group mr-1" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena" data-toggle="modal"  id="modIzmeniMeni" data-target="#modalUnosMeni"><i class="fas fa-user-edit"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="modUnosMeni"   data-target="#modalUnosMeni"><i class="fas fa-user-plus"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="btnBrisanjeMeni" ><i class="fas fa-trash" style="color: red;"></i></button>
                            </div>
                            <button id="selektovaniMeni" class="btn ml-2  selektovano" ></button>
                        
                    </div>
                            
                    <div class="card-body">
                            <table class="table mojeTabele cell-border" style="width: 100%;"  id="tblMeniji">
                                <thead >
                                    <tr>
                                        <th id="tblSelMeniNaziv">NAZIV</th>
                                        <th>PRIKAZANI NAZIV</th>
                                        <th>REDOSLED</th>
                                        
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>            
                    </div>
                </div>

            </div>
                    {{-- Modal unos Meni --}}
                 {{--    <div id="modalUnosMeni" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content"> --}}
                             {{--    <div class="modal-header">
                                    <h4 class="modal-title text-xs-center">Kreiraj meni</h4>
                                </div> --}}
                                <div class="modal-body " id="prviModal">
                                    {{-- <form role="form" method="POST" action="{{ route('meniUnos')}}"> --}}
                                       {{ csrf_field() }} 
                                        <div class="form-group">
                                            <label class="control-label">NAZIV</label>
                                            <div>
                                                <input type="text" placeholder="Naziv..." class="form-control input-lg" name="MENI_NAZIV_UNOS" id="MENI_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">PRIKAZNI NAZIV</label>
                                            <div>
                                                <input type="text" placeholder="Prikazni naziv..." class="form-control input-lg" name="MENI_PRIKAZNI_NAZIV_UNOS" id="MENI_PRIKAZNI_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">REDOSLED</label>
                                            <div>
                                                <input type="text" placeholder="Redosled..." class="form-control input-lg" name="MENI_REDOSLED_UNOS" id="MENI_REDOSLED_UNOS" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div >
                                                {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                                                 {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                 <button id="meniIzmena" class="btn btn-info ">Meni izmena</button>
                                                {{-- <button id="meniUnos" class="btn btn-info ">Meni unos</button> --}}
                                                {{-- <button id="meniReset" class="btn btn-danger">RESET</button> --}}
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                                <div class="modal-body " id="prviModal2">
                                    {{-- <form role="form" method="POST" action="{{ route('meniUnos')}}"> --}}
                                       {{ csrf_field() }} 
                                        <div class="form-group">
                                            <label class="control-label">NAZIV</label>
                                            <div>
                                                <input type="text" placeholder="Naziv..." class="form-control input-lg" name="MENI_NAZIV_UNOS" id="MENI_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">PRIKAZNI NAZIV</label>
                                            <div>
                                                <input type="text" placeholder="Prikazni naziv..." class="form-control input-lg" name="MENI_PRIKAZNI_NAZIV_UNOS" id="MENI_PRIKAZNI_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">REDOSLED</label>
                                            <div>
                                                <input type="text" placeholder="Redosled..." class="form-control input-lg" name="MENI_REDOSLED_UNOS" id="MENI_REDOSLED_UNOS2" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div >
                                                {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                                                 {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                 {{-- <button id="meniIzmena" class="btn btn-info ">Meni izmena</button> --}}
                                                <button id="meniUnos" class="btn btn-info ">Meni unos</button>
                                                <button id="meniReset" class="btn btn-danger">RESET</button>
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                              
                     {{--        </div>
                        </div>
                    </div> --}}

                  {{-- Tabela za Tabove --}}
            <div class="container col-sm-12 col-xs-12  p-1" id="drugi">
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
                            <h3 style="float: right;" class="card-title karticaNaziv" class="m_responsive_header">Aplikacije</h3>
                            <div class="btn-group mr-1" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena" data-toggle="modal"  id="modIzmeniAplikaciju" data-target="#modalUnosAplikacije"><i class="fas fa-user-edit"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="modUnosAplikacije"  data-target="#modalUnosAplikacije"><i class="fas fa-user-plus"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="btnBrisanjeAplikacije" ><i class="fas fa-trash" style="color: red;"></i></button>
                            </div>

                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <select  class=" form-control mb-2" id="APP_JEZIK_UNOS">
                                        @foreach ($jeziciKolekcija as $jezik)
                                        <option value="{{$jezik->jezik}}">{{$jezik->jezik_naziv}}</option>
                                        @endforeach  
                            </select>
                            </div>
                            <button id="selektovanaAplikacija" class="btn ml-2 selektovano" ></button>


                            
                    </div>
                            
                    <div class="card-body" >
                        <div id="tblAplikacijeD">
                                <table class="table mojeTabele cell-border"  id="tblAplikacije" style="width: 100%;">
                                <thead >
                                    <tr>
                                        <th id="tblSelAplikacijaNaziv">APLIKACIJA</th>
                                        <th>PRIKAZNI NAZIV</th>
                                        <th>ANDROID MASKA</th>
                                        <th>PODSISTEM</th>
                                        <th>WS PARAMETAR</th>
                                        <th>WS PARAMETAR2</th>
                                        <th>SNACK POR</th>
                                    </tr>
                                </thead>
                            </table>         
                        </div>
                        <div id="tblAplikacije_enD">
                              <table class="table mojeTabele cell-border"  id="tblAplikacije_en" style="width: 100%;">
                                <thead >
                                    <tr>
                                        <th id="tblSelAplikacijaNaziv_en">APLIKACIJA</th>
                                        <th>PRIKAZNI NAZIV</th>
                                        <th>JEZIK</th>
                                        
                                    </tr>
                                </thead>
                            </table>  
                        </div>   
                    </div>
                </div>

            </div>

              {{-- Modal unos aplikacija --}}
                   {{--  <div id="modalUnosAplikacije" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content"> --}}
                            
                                <div class="modal-body mb-3" id="drugiModal">
                                    {{-- <form role="form" method="POST" action="{{ route('meniUnos')}}"> --}}
                                       {{ csrf_field() }} 
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3">NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="Naziv..." class="form-control input-lg" name="APP_NAZIV_UNOS" id="APP_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group  row mb-1">
                                            <label class="control-label col-3">PRIKAZNI NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="Prikazni naziv..." class="form-control input-lg" name="APP_PRIKAZNI_NAZIV_UNOS" id="APP_PRIKAZNI_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group  row mb-1">
                                            <label class="control-label col-3">ANDROID MASKA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="Android maska..." class="form-control input-lg" name="APP_ANDROID_MASKA_UNOS" id="APP_ANDROID_MASKA_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3">WS PARAMETAR</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="WS PARAMETAR..." class="form-control input-lg" name="APP_WS_PARAMETAR_UNOS" id="APP_WS_PARAMETAR_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3">WS PARAMETAR2</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="WS PARAMETAR2..." class="form-control input-lg" name="APP_WS_PARAMETAR2_UNOS" id="APP_WS_PARAMETAR2_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3">SNACK PORUKA DO</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SNACK PORUKA DO..." class="form-control input-lg" name="APP_SNACK_PORUKA_DO_UNOS" id="APP_SNACK_PORUKA_DO_UNOS" value="">
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row mb-1">
                                            <div class="row col-12">
                                                <label class="control-label col-3">MENI</label>
                                                <select name="APP_MENI_UNOS" class="form-control col-9" id="APP_MENI_UNOS">
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div >
                                                {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                                                 {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                 <button id="aplikacijaIzmena" class="btn btn-info ">Izmeni</button>
                                                {{-- <button id="aplikacijaUnos" class="btn btn-info ">Kreiraj</button> --}}
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                                
                                  <div class="modal-body " id="drugiModal2">
                                    {{-- <form role="form" method="POST" action="{{ route('meniUnos')}}"> --}}
                                       {{ csrf_field() }} 
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3">NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="Naziv..." class="form-control input-lg" name="APP_NAZIV_UNOS" id="APP_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group  row mb-1">
                                            <label class="control-label col-3">PRIKAZNI NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="Prikazni naziv..." class="form-control input-lg" name="APP_PRIKAZNI_NAZIV_UNOS" id="APP_PRIKAZNI_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group  row mb-1">
                                            <label class="control-label col-3">ANDROID MASKA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="Android maska..." class="form-control input-lg" name="APP_ANDROID_MASKA_UNOS" id="APP_ANDROID_MASKA_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3">WS PARAMETAR</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="WS PARAMETAR..." class="form-control input-lg" name="APP_WS_PARAMETAR_UNOS" id="APP_WS_PARAMETAR_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3">WS PARAMETAR2</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="WS PARAMETAR2..." class="form-control input-lg" name="APP_WS_PARAMETAR2_UNOS" id="APP_WS_PARAMETAR2_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3">SNACK PORUKA DO</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SNACK PORUKA DO..." class="form-control input-lg" name="APP_SNACK_PORUKA_DO_UNOS" id="APP_SNACK_PORUKA_DO_UNOS2" value="">
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row mb-1">
                                            <div class="row col-12">
                                                <label class="control-label col-3">MENI</label>
                                                <select name="APP_MENI_UNOS" class="form-control col-9" id="APP_MENI_UNOS2">
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div >
                                                {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                                                 {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                 {{-- <button id="aplikacijaIzmena" class="btn btn-info ">Izmeni</button> --}}
                                                <button id="aplikacijaUnos" class="btn btn-info ">Kreiraj</button>
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                              
                          {{--   </div>
                        </div>
                    </div> --}}



  

            
        </div>
        <div class="row">
    
          

            {{-- Tabela za aplikacije --}}
            <div class="container col-sm-4 col-xs-12  p-1" id="treci">
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
                            <h3 style="float: right;" class="card-title karticaNaziv" class="m_responsive_header">Tabovi</h3>
                            <div class="btn-group mr-1" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena" data-toggle="modal"  id="modIzmenaTaba" data-target="#modalUnosTaba"><i class="fas fa-user-edit"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="modUnosTaba"  data-target="#modalUnosTaba"><i class="fas fa-user-plus"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="btnBrisanjeTaba" ><i class="fas fa-trash" style="color: red;"></i></button>
                            </div>
                            <button id="selektovaniTab" class="btn ml-2 selektovano"></button>
                        
                    </div>
                            
                    <div class="card-body">
                                <table class="table mojeTabele cell-border" style="width: 100%;"  id="tblTabovi">
                                <thead >
                                    <tr>
                                        <th >TAB_ID</th>
                                        <th id="tblSelTabNaziv">TAB_BR</th>
                                        <th>TAB_NAZIV</th>
                                        <th>AND_APLIKACIJE_PK</th>
                                    </tr>
                                </thead>
                            </table>            
                    </div>
                </div>

            </div>

              {{-- Modal unos taba --}}
                   {{--  <div id="modalUnosTaba" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-xs-center">Kreiraj tab</h4>
                                </div> --}}
                                <div class="modal-body " id="treciModal">
                                    {{-- <form role="form" method="POST" action="{{ route('meniUnos')}}"> --}}
                                       {{ csrf_field() }} 
                                        <div class="form-group">
                                            <label class="control-label">TAB ID</label>
                                            <div>
                                                <input type="text" placeholder="TAB ID..." class="form-control input-lg" name="TAB_ID_UNOS" id="TAB_ID_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">TAB BR</label>
                                            <div>
                                                <input type="text" placeholder="TAB BR..." class="form-control input-lg" name="TAB_BR_UNOS" id="TAB_BR_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">TAB NAZIV</label>
                                            <div>
                                                <input type="text" placeholder="TAB NAZIV..." class="form-control input-lg" name="TAB_NAZIV_UNOS" id="TAB_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label">AND_APLIKACIJE_PK</label>
                                                <select name="TAB_AND_APLIKACIJE_PK_UNOS" class="form-control" id="TAB_AND_APLIKACIJE_PK_UNOS">
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div >
                                                {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                                                 {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                <button id="tabIzmena" class="btn btn-info ">Tab izmena</button>
                                                {{-- <button id="tabUnos" class="btn btn-info ">Tab unos</button> --}}
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                                 <div class="modal-body " id="treciModal2">
                                    {{-- <form role="form" method="POST" action="{{ route('meniUnos')}}"> --}}
                                       {{ csrf_field() }} 
                                       {{--  <div class="form-group">
                                            <label class="control-label">TAB ID</label>
                                            <div>
                                                <input type="text" placeholder="TAB ID..." class="form-control input-lg" name="TAB_ID_UNOS" id="TAB_ID_UNOS2" value="">
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <label class="control-label">TAB BR</label>
                                            <div>
                                                <input type="text" placeholder="TAB BR..." class="form-control input-lg" name="TAB_BR_UNOS" id="TAB_BR_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">TAB NAZIV</label>
                                            <div>
                                                <input type="text" placeholder="TAB NAZIV..." class="form-control input-lg" name="TAB_NAZIV_UNOS" id="TAB_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label">AND_APLIKACIJE_PK</label>
                                                <select name="TAB_AND_APLIKACIJE_PK_UNOS" class="form-control" id="TAB_AND_APLIKACIJE_PK_UNOS2">
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div >
                                                {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                                                 {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                {{-- <button id="tabIzmena" class="btn btn-info ">Tab izmena</button> --}}
                                                <button id="tabUnos" class="btn btn-info ">Tab unos</button>
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                       {{--        
                            </div>
                        </div>
                    </div> --}}

         
            {{-- Tabela za stavke tabova --}}
              <div class="container col-sm-12 col-xs-12  p-1" id="cetvrti">
                @if (session('success'))
                    <div id = "uspesnostTabStavka" class="alert alert-success">
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
                            <h3 style="float: right;" class="card-title karticaNaziv" class="m_responsive_header">Stavke taba</h3>
                            <div class="btn-group mr-1" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena" data-toggle="modal"  id="modIzmeniStavkuTaba" data-target="#modalUnosTabStavke"><i class="fas fa-user-edit"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="modUnosStavkuTaba"  data-target="#modalUnosTabStavke"><i class="fas fa-user-plus"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                              <button class="btnUnosIzmena"  data-toggle="modal" id="btnBrisanjeStavkeTaba" ><i class="fas fa-trash" style="color: red;"></i></button>
                            </div>
                            <div class="btn-group" style="float: left;" role="group" aria-label="Basic example">
                            
                             <select  class=" form-control mb-2" id="TAB_STAVKE_JEZIK_PRIMENE">
                                        @foreach ($jeziciKolekcija as $jezik)
                                        <option value="{{$jezik->jezik}}">{{$jezik->jezik_naziv}}</option>
                                        @endforeach
                                          
                                      </select>
                            </div>
                            <button id="selektovanaStavka" class="btn ml-2  selektovano"></button>
                        
                    </div>
                            
                    <div class="card-body">
                             <div  id="tblTaboviStavkeD">  
                            <table class="table mojeTabele cell-border" style="width: 100%;"  id="tblTaboviStavke">
                                <thead >
                                    <tr>
                                        <th id="tblSelMeniNaziv">APLIKACIJA</th>
                                        <th>STAVKA</th>
                                        <th>BROJ_TABA</th>
                                        <th>GRAFIK</th>
                                        <th>BROJ_SERIJA</th>
                                        <th>SERIJA1_NAZIV</th>
                                        <th>SERIJA2_NAZIV</th>
                                        <th>SERIJA3_NAZIV</th>
                                        <th>NAZIV_IZVESTAJA</th>
                                        <th>WEB_SERVIS</th>
                                        <th>SERIJA4_NAZIV</th>
                                        <th>SERIJA5_NAZIV</th>
                                        <th>DD_STAVKA</th>
                                        <th>DD_GRAFIK</th>
                                        <th>DD_BR_SERIJA</th>
                                        <th>DD_SERIJA1_NAZIV</th>
                                        <th>DD_SERIJA2_NAZIV</th>
                                        <th>DD_SERIJA3_NAZIV</th>
                                        <th>DD_SERIJA4_NAZIV</th>
                                        <th>DD_SERIJA5_NAZIV</th>
                                        <th>DD_NAZIV_IZVESTAJA</th>
                                        <th>DD_WEB_SERVIS</th>
                                        
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>    
                        </div>
                            <div  id="tblTaboviStavke_enD">  
                            <table style="display: hidden;" class="table mojeTabele cell-border" style="width: 100%;"  id="tblTaboviStavke_en">
                                <thead >
                                    <tr>
                                        <th>APLIKACIJA</th>
                                        <th>STAVKA</th>
                                     
                                 
                                   
                                        <th>SERIJA1_NAZIV</th>
                                        <th>SERIJA2_NAZIV</th>
                                        <th>SERIJA3_NAZIV</th>
                                        <th>NAZIV_IZVESTAJA</th>
                           
                                        <th>SERIJA4_NAZIV</th>
                                        <th>SERIJA5_NAZIV</th>
                          
                                 
                                        <th>DD_SERIJA1_NAZIV</th>
                                        <th>DD_SERIJA2_NAZIV</th>
                                        <th>DD_SERIJA3_NAZIV</th>
                                        <th>DD_SERIJA4_NAZIV</th>
                                        <th>DD_SERIJA5_NAZIV</th>
                                        <th>DD_NAZIV_IZVESTAJA</th>
                                        <th>JEZIK</th>
                                  
                                        
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>      
                            </div>            
                    </div>
                </div>

            </div>

            {{-- Modal unos stavke taba --}}
                   {{--  <div id="modalUnosTabStavke" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-xs-center">Dodaj stavku taba</h4>
                                </div> --}}
                                  
                                <div class="row col-12 mb-5">

                                <div class="modal-body col-6" id="cetvrtiModal">
                                    
                                    {{-- <form role="form" method="POST" action="{{ route('meniUnos')}}"> --}}
                                       {{ csrf_field() }} 
                                       <div class="row">
                                       <div class="col-6">
                                        <div class="form-group   row mb-1">
                                           {{--  <div class="row col-12"> --}}
                                                <label class="control-label col-3 mojFont">APLIKACIJE</label>
                                                <select name="TAB_STAVKE_APLIKACIJE_UNOS" class="form-control col-8 mojFont" id="TAB_STAVKE_APLIKACIJE_UNOS">
                                                   
                                                </select>
                                            {{-- </div> --}}
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">STAVKA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="STAVKA..." class="form-control input-lg" name="TAB_STAVKE_STAVKA_UNOS" id="TAB_STAVKE_STAVKA_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">GRAFIK</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="GRAFIK..." class="form-control input-lg" name="TAB_STAVKE_GRAFIK_UNOS" id="TAB_STAVKE_GRAFIK_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">BROJ SERIJA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="WS PARAMETAR..." class="form-control input-lg" name="TAB_STAVKE_BROJ_SERIJA_UNOS" id="TAB_STAVKE_BROJ_SERIJA_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA1 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA1 NAZIV..." class="form-control input-lg" name="TAB_STAVKE_SERIJA1_NAZIV_UNOS" id="TAB_STAVKE_SERIJA1_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA2 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA2 NAZIV..." class="form-control input-lg" name="TAB_STAVKE_SERIJA2_NAZIV_UNOS" id="TAB_STAVKE_SERIJA2_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA3 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA3 NAZIV..." class="form-control input-lg" name="TAB_STAVKE_SERIJA3_NAZIV_UNOS" id="TAB_STAVKE_SERIJA3_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">NAZIV IZVESTAJA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="NAZIV IZVESTAJA..." class="form-control input-lg" name="TAB_STAVKE_NAZIV_IZVESTAJA_UNOS" id="TAB_STAVKE_NAZIV_IZVESTAJA_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD NAZIV IZVESTAJA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD NAZIV IZVESTAJA..." class="form-control input-lg" name="TAB_STAVKE_DD_NAZIV_IZVESTAJA_UNOS" id="TAB_STAVKE_DD_NAZIV_IZVESTAJA_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD WEB SERVIS</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD WEB SERVIS..." class="form-control input-lg" name="TAB_STAVKE_DD_WEB_SERVIS_UNOS" id="TAB_STAVKE_DD_WEB_SERVIS_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <div class="row col-12">
                                                <label class="control-label col-3 mojFont">BR TABA</label>
                                                <select name="TAB_STAVKE_BR_TABA_UNOS" class="form-control col-9" id="TAB_STAVKE_BR_TABA_UNOS">
                                                   
                                                </select>
                                            </div>
                                        </div>


                                    </div>


                                     <div class="col-6">
                                        <div class="form-group  row mb-1">
                                            <label class="control-label col-3 mojFont">WEB SERVIS</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="WEB SERVIS..." class="form-control input-lg" name="TAB_STAVKE_WEB_SERVIS_UNOS" id="TAB_STAVKE_WEB_SERVIS_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA4 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA4 NAZIV..." class="form-control input-lg" name="TAB_SERIJA4_NAZIV_UNOS" id="TAB_SERIJA4_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA5 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA5 NAZIV..." class="form-control input-lg" name="TAB_SERIJA5_NAZIV_UNOS" id="TAB_SERIJA5_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD STAVKA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD STAVKA..." class="form-control input-lg" name="TAB_DD_STAVKA_UNOS" id="TAB_DD_STAVKA_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3  mojFont">DD GRAFIK</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD GRAFIK..." class="form-control input-lg" name="TAB_DD_GRAFIK_UNOS" id="TAB_DD_GRAFIK_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD BR SERIJA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD BR SERIJA..." class="form-control input-lg" name="TAB_DD_BR_SERIJA_UNOS" id="TAB_DD_BR_SERIJA_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA1 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA1 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA1_NAZIV_UNOS" id="TAB_DD_SERIJA1_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA2 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA2 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA2_NAZIV_UNOS" id="TAB_DD_SERIJA2_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA3 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA3 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA3_NAZIV_UNOS" id="TAB_DD_SERIJA3_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA4 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA4 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA4_NAZIV_UNOS" id="TAB_DD_SERIJA4_NAZIV_UNOS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA5 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA5 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA5_NAZIV_UNOS" id="TAB_DD_SERIJA5_NAZIV_UNOS" value="">
                                            </div>
                                        </div>


                                        </div>

                                    </div>
                                        
                                        <div class="form-group">
                                            <div >
                                                {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                <button id="tabStavkeIzmena" class="btn btn-info ">Izmena</button>
                                                {{-- <button id="tabStavkeUnos" class="btn btn-info ">Unos</button> --}}
                                            </div>
                                        </div>
                                  

                                    {{-- </form> --}}
                                </div>
                                <div class="modal-body col-6" id="cetvrtiModal2">
                                    {{-- <form role="form" method="POST" action="{{ route('meniUnos')}}"> --}}
                                       {{ csrf_field() }} 
                                       <div class="row">
                                       <div class="col-6">
                                        <div class="form-group  row mb-1">
                                            <div class="row col-12">
                                                <label class="control-label col-5 mojFont">APLIKACIJE</label>
                                                <select name="TAB_STAVKE_APLIKACIJE_UNOS" class="form-control col-7 mojFont" id="TAB_STAVKE_APLIKACIJE_UNOS2">
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">STAVKA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="STAVKA..." class="form-control input-lg" name="TAB_STAVKE_STAVKA_UNOS" id="TAB_STAVKE_STAVKA_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">GRAFIK</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="GRAFIK..." class="form-control input-lg" name="TAB_STAVKE_GRAFIK_UNOS" id="TAB_STAVKE_GRAFIK_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">BROJ SERIJA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="WS PARAMETAR..." class="form-control input-lg" name="TAB_STAVKE_BROJ_SERIJA_UNOS" id="TAB_STAVKE_BROJ_SERIJA_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA1 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA1 NAZIV..." class="form-control input-lg" name="TAB_STAVKE_SERIJA1_NAZIV_UNOS" id="TAB_STAVKE_SERIJA1_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA2 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA2 NAZIV..." class="form-control input-lg" name="TAB_STAVKE_SERIJA2_NAZIV_UNOS" id="TAB_STAVKE_SERIJA2_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA3 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA3 NAZIV..." class="form-control input-lg" name="TAB_STAVKE_SERIJA3_NAZIV_UNOS" id="TAB_STAVKE_SERIJA3_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">NAZIV IZVESTAJA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="NAZIV IZVESTAJA..." class="form-control input-lg" name="TAB_STAVKE_NAZIV_IZVESTAJA_UNOS" id="TAB_STAVKE_NAZIV_IZVESTAJA_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD NAZIV IZVESTAJA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD NAZIV IZVESTAJA..." class="form-control input-lg" name="TAB_STAVKE_DD_NAZIV_IZVESTAJA_UNOS" id="TAB_STAVKE_DD_NAZIV_IZVESTAJA_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD WEB SERVIS</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD WEB SERVIS..." class="form-control input-lg" name="TAB_STAVKE_DD_WEB_SERVIS_UNOS" id="TAB_STAVKE_DD_WEB_SERVIS_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <div class="row col-12">
                                                <label class="control-label col-3 mojFont">BR TABA</label>
                                                <select name="TAB_STAVKE_BR_TABA_UNOS" class="form-control col-9" id="TAB_STAVKE_BR_TABA_UNOS2">
                                                   
                                                </select>
                                            </div>
                                        </div>


                                    </div>


                                     <div class="col-6">
                                        <div class="form-group  row mb-1">
                                            <label class="control-label col-3 mojFont">WEB SERVIS</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="WEB SERVIS..." class="form-control input-lg" name="TAB_STAVKE_WEB_SERVIS_UNOS" id="TAB_STAVKE_WEB_SERVIS_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA4 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA4 NAZIV..." class="form-control input-lg" name="TAB_SERIJA4_NAZIV_UNOS" id="TAB_SERIJA4_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">SERIJA5 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="SERIJA5 NAZIV..." class="form-control input-lg" name="TAB_SERIJA5_NAZIV_UNOS" id="TAB_SERIJA5_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD STAVKA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD STAVKA..." class="form-control input-lg" name="TAB_DD_STAVKA_UNOS" id="TAB_DD_STAVKA_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3  mojFont">DD GRAFIK</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD GRAFIK..." class="form-control input-lg" name="TAB_DD_GRAFIK_UNOS" id="TAB_DD_GRAFIK_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD BR SERIJA</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD BR SERIJA..." class="form-control input-lg" name="TAB_DD_BR_SERIJA_UNOS" id="TAB_DD_BR_SERIJA_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA1 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA1 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA1_NAZIV_UNOS" id="TAB_DD_SERIJA1_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA2 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA2 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA2_NAZIV_UNOS" id="TAB_DD_SERIJA2_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA3 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA3 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA3_NAZIV_UNOS" id="TAB_DD_SERIJA3_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA4 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA4 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA4_NAZIV_UNOS" id="TAB_DD_SERIJA4_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="control-label col-3 mojFont">DD SERIJA5 NAZIV</label>
                                            <div class="col-9">
                                                <input type="text" placeholder="DD SERIJA5 NAZIV..." class="form-control input-lg" name="TAB_DD_SERIJA5_NAZIV_UNOS" id="TAB_DD_SERIJA5_NAZIV_UNOS2" value="">
                                            </div>
                                        </div>


                                        </div>

                                    </div>
                                        
                                        <div class="form-group">
                                            <div >
                                                {{-- <a class="btn btn-link" href="">Forgot Your Password?</a> --}}
                                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                {{-- <button id="tabStavkeIzmena" class="btn btn-info ">Izmena</button> --}}
                                                <button id="tabStavkeUnos" class="btn btn-info ">Unos</button>
                                            </div>
                                        </div>
                                </div>

                            </div>
                              
                           {{--  </div>
                        </div>
                    </div> --}}


            
        </div>
    </div>

    <script>
                $('#prvi').show();
                $('#prviModal').show();
                $('#prviModal2').show();
                $('#drugi').hide();
                $('#drugiModal').hide();
                $('#drugiModal2').hide();
                $('#treciModal').hide();
                $('#treciModal2').hide();

                 $('#cetvrtiModal').hide();
                  $('#cetvrtiModal2').hide();

                $('#treci').hide();
                $('#cetvrti').hide();
        $('#prikaziSetMenija').click(function(){

                $('#prvi').show();
                $('#prviModal').show();
                 $('#prviModal2').show();
                $('#drugi').hide();
                $('#drugiModal').hide();
                $('#drugiModal2').hide();
                $('#treci').hide();
                $('#treciModal').hide();
                $('#treciModal2').hide();

                   $('#cetvrtiModal').hide();
                  $('#cetvrtiModal2').hide();
                $('#cetvrti').hide();

        })
           $('#prikaziSetAplikacija').click(function(){
              if (selektovaniMeni == ''){
                        alert('selektuj meni');
                        return false;
                    }
                $('#prvi').hide();
                $('#prviModal').hide();$('#prviModal2').hide();
                $('#drugi').show();$('#drugiModal').show();$('#drugiModal2').show();
                $('#treci').hide();
                $('#treciModal').hide();
                $('#treciModal2').hide();

                   $('#cetvrtiModal').hide();
                  $('#cetvrtiModal2').hide();
                $('#cetvrti').hide();

        })
              $('#prikaziSetTabova').click(function(){
                 if (selektovanaAplikacija == ''){
                        alert('selektuj aplikaciju');
                        return false;
                    }
                $('#prvi').hide();
                $('#prviModal').hide();$('#prviModal2').hide();
                $('#drugi').hide();$('#drugiModal').hide();$('#drugiModal2').hide();
                $('#treci').show();
                $('#treciModal').show();
                $('#treciModal2').show();

                   $('#cetvrtiModal').hide();
                  $('#cetvrtiModal2').hide();
                $('#cetvrti').hide();

        })
                 $('#prikaziSetStavki').click(function(){
                     if (selektovaniTab == ''){
                        alert('selektuj tab');
                        return false;
                    }
                $('#prvi').hide();
                $('#prviModal').hide();$('#prviModal2').hide();
                $('#drugi').hide();$('#drugiModal').hide();$('#drugiModal2').hide();
                $('#treci').hide();
                $('#treciModal').hide();
                $('#treciModal2').hide();

                   $('#cetvrtiModal').show();
                  $('#cetvrtiModal2').show();
                $('#cetvrti').show();

        });
                  $('#tblMeniji tbody').on('dblclick','tr',function(event){

                    $('#prikaziSetAplikacija').trigger('click');
                    tblAplikacije.ajax.reload();
                     tblAplikacije_en.ajax.reload();
                  });

               
                
        
    </script>
    <script>
        $(document).ready(function(){
           $('#tblAplikacije tbody').on('dblclick','tr',function(event){
               
                    $('#prikaziSetTabova').trigger('click');
                    tblTabovi.ajax.reload();
                  });


                  $('#tblTabovi tbody').on('dblclick','tr',function(event){

                    $('#prikaziSetStavki').trigger('click');
                    tblTaboviStavke.ajax.reload();
                    tblTaboviStavke_en.ajax.reload();
                  });
              });
    </script>

     <script>
        {{-- Skripta za inicijalno izvrsavanje --}}
        $("#selektovaniMeni").hide();
        $("#selektovanaAplikacija").hide();
        $("#selektovaniTab").hide();
        $("#selektovanaStavka").hide();
        var pickedupMeni;
        var pickedupAplikacije;
        var pickedupTab;
     </script>
     <script>
        $('#modUnosStavkuTaba').click(function(){
            // $('#tabStavkeUnos').show();
            // $('#tabStavkeIzmena').hide();

             $('#TAB_STAVKE_APLIKACIJE_UNOS').prop('disabled', false);
             $('#TAB_STAVKE_BR_TABA_UNOS').prop('disabled', false);

            $('#modalUnosTabStavke').find('input:text').val(''); 
            

        });

        $('#modIzmeniStavkuTaba').click(function(e){
            // $('#tabStavkeUnos').hide();
            // $('#tabStavkeIzmena').show();

            if (tabStavkeBrisanjeAplikacija=='')
            {
                alert('Niste selektovali stavku za izmenu!!!!');
                // $('#modalUnosMeni').modal('toggle');
                e.stopPropagation();//ne otvaraj modal ako nije red selektovan
            }
            $('#TAB_STAVKE_APLIKACIJE_UNOS').prop('disabled', true);
            $('#TAB_STAVKE_BR_TABA_UNOS').prop('disabled', true);

            $('#TAB_STAVKE_APLIKACIJE_UNOS').val(tabStavkeBrisanjeAplikacija);
            $('#TAB_STAVKE_STAVKA_UNOS').val(tabStavkaStavkaUnos);
            $('#TAB_STAVKE_GRAFIK_UNOS').val(tabStavkaGrafikUnos);
            $('#TAB_STAVKE_BROJ_SERIJA_UNOS').val(tabStavkaBrojSerijaUnos);
            $('#TAB_STAVKE_SERIJA1_NAZIV_UNOS').val(tabStavkaSerija1NazivUnos);
            $('#TAB_STAVKE_SERIJA2_NAZIV_UNOS').val(tabStavkaSerija2NazivUnos);
            $('#TAB_STAVKE_SERIJA3_NAZIV_UNOS').val(tabStavkaSerija3NazivUnos);
            $('#TAB_STAVKE_NAZIV_IZVESTAJA_UNOS').val(tabStavkaNazivIsvestajaUnos);
            $('#TAB_STAVKE_DD_NAZIV_IZVESTAJA_UNOS').val(tabStavkaDDNazivIzvestaja);
            $('#TAB_STAVKE_DD_WEB_SERVIS_UNOS').val(tabStavkaDdWebServis);
            $('#TAB_STAVKE_WEB_SERVIS_UNOS').val(tabStavkaWebServisUnos);
            $('#TAB_SERIJA4_NAZIV_UNOS').val(tabStavkaSerija4NazivUnos);
            $('#TAB_SERIJA5_NAZIV_UNOS').val(tabStavkaSerija5NazivUnos);
            $('#TAB_DD_STAVKA_UNOS').val(tabStavkaDDStavkaUnos);
            $('#TAB_DD_GRAFIK_UNOS').val(tabStavkaDDGrafikUnos);
            $('#TAB_DD_BR_SERIJA_UNOS').val(tabStavkaDdBrSerijaUnos);
            $('#TAB_DD_SERIJA1_NAZIV_UNOS').val(tabStavkaDdSerija1NazivUnos);
            $('#TAB_DD_SERIJA2_NAZIV_UNOS').val(tabStavkaDdSerija2NazivUnos);
            $('#TAB_DD_SERIJA3_NAZIV_UNOS').val(tabStavkaDdSerija3NazivUnos);
            $('#TAB_DD_SERIJA4_NAZIV_UNOS').val(tabStavkaDdSerija4NazivUnos);
            $('#TAB_DD_SERIJA5_NAZIV_UNOS').val(tabStavkaDdSerija5NazivUnos);
           
            
        });
         
     </script>
     <script>
        $('#modUnosTaba').click(function(){
            // $('#tabUnos').show();
            // $('#tabIzmena').hide();

             $('#TAB_BR_UNOS').prop('readonly', false);
             $('#TAB_AND_APLIKACIJE_PK_UNOS').prop('disabled', false);

            $('#modalUnosTaba').find('input:text').val(''); 
            

        });
        $('#modIzmenaTaba').click(function(e){
            // $('#tabUnos').hide();
            // $('#tabIzmena').show();

            if (tabBrisanjeAplikacija=='')
            {
                alert('Niste selektovali tab za izmenu!!!!');
                // $('#modalUnosMeni').modal('toggle');
                e.stopPropagation();//ne otvaraj modal ako nije red selektovan
            }
            //$('#TAB_BR_UNOS').prop('readonly', true);
            $('#TAB_ID_UNOS').prop('readonly', true);
            // $('#TAB_AND_APLIKACIJE_PK_UNOS').prop('disabled', true);

            $('#TAB_ID_UNOS').val(tabId);
            $('#TAB_BR_UNOS').val(tabBrisanjeBroj);
            $('#TAB_NAZIV_UNOS').val(tabNaziv);
            $('#TAB_AND_APLIKACIJE_PK_UNOS').val(tabBrisanjeAplikacija);
            
        });
         
     </script>
     <script>
        $('#modUnosAplikacije').click(function(){
            //$('#aplikacijaUnos').show();
            //$('#aplikacijaIzmena').hide();

             $('#APP_NAZIV_UNOS').prop('readonly', false);
             $('#APP_MENI_UNOS').prop('disabled', false);

            $('#modalUnosAplikacije').find('input:text').val(''); 
            

        });
        $('#modIzmeniAplikaciju').click(function(e){
           // $('#aplikacijaUnos').hide();
            //$('#aplikacijaIzmena').show();
            if (selektovanaAplikacija=='')
            {
                alert('Niste selektovali aplikacijue za izmenu!!!!');
                // $('#modalUnosMeni').modal('toggle');
                e.stopPropagation();//ne otvaraj modal ako nije red selektovan
            }
            $('#APP_NAZIV_UNOS').prop('readonly', true);
            $('#APP_MENI_UNOS').prop('disabled', true);

            $('#APP_NAZIV_UNOS').val(selektovanaAplikacija);
            $('#APP_PRIKAZNI_NAZIV_UNOS').val(appPrikazniNaziv);
            $('#APP_ANDROID_MASKA_UNOS').val(appAndroidMaska);
            $('#APP_WS_PARAMETAR_UNOS').val(appWsParametar);
            $('#APP_WS_PARAMETAR2_UNOS').val(appWsParametar2);
            $('#APP_SNACK_PORUKA_DO_UNOS').val(appSnackPorukaDo);
            $('#APP_MENI_UNOS').val(appMeni);


            

        });

          function modIzmeniAplikaciju_en(){
           // $('#aplikacijaUnos').hide();
            //$('#aplikacijaIzmena').show();
            if (selektovanaAplikacija=='')
            {
                alert('Niste selektovali aplikacijue za izmenu!!!!');
                // $('#modalUnosMeni').modal('toggle');
                e.stopPropagation();//ne otvaraj modal ako nije red selektovan
            }
            $('#APP_NAZIV_UNOS').prop('readonly', true);
            $('#APP_MENI_UNOS').prop('disabled', true);

            $('#APP_NAZIV_UNOS').val(selektovanaAplikacija);
            $('#APP_PRIKAZNI_NAZIV_UNOS').val(appPrikazniNaziv);
           


            

        };
         
     </script>
     <script>
        $('#modUnosMeni').click(function(){
            $('#meniUnos').show();
            //$('#meniIzmena').hide();
             $('#MENI_NAZIV_UNOS').prop('readonly', false);

            $('#prviModal2').find('input:text').val(''); 

        });
        $('#meniReset').click(function(){
            $('#modUnosMeni').trigger('click');
        })
        $('#modIzmeniMeni').click(function(e){
           // $('#meniUnos').hide();
            $('#meniIzmena').show();
            if (meniBrisanjeMeni=='')
            {
                alert('Niste selektovali meni za izmenu!!!!');
                // $('#modalUnosMeni').modal('toggle');
                e.stopPropagation();//ne otvaraj modal ako nije red selektovan
            }
            $('#MENI_NAZIV_UNOS').prop('readonly', true);
            $('#MENI_NAZIV_UNOS').val(meniBrisanjeMeni);
            $('#MENI_PRIKAZNI_NAZIV_UNOS').val(meniPrikazniNaziv);
            $('#MENI_REDOSLED_UNOS').val(meniRedosled);



        });
  
     </script>
     <script>
        $('#tabStavkeUnos').click(function(){
         
    $.get("tabStavkeUnos",{
        aplikacija: $('#TAB_STAVKE_APLIKACIJE_UNOS2').val(),
        stavka: $("#TAB_STAVKE_STAVKA_UNOS2").val(),
        grafik: $("#TAB_STAVKE_GRAFIK_UNOS2").val(),
        broj_serija: $("#TAB_STAVKE_BROJ_SERIJA_UNOS2").val(),
        serija1_naziv: $("#TAB_STAVKE_SERIJA1_NAZIV_UNOS2").val(),
        serija2_naziv: $("#TAB_STAVKE_SERIJA2_NAZIV_UNOS2").val(),
        serija3_naziv: $("#TAB_STAVKE_SERIJA3_NAZIV_UNOS2").val(),
        naziv_isvestaja: $("#TAB_STAVKE_NAZIV_IZVESTAJA_UNOS2").val(),
        dd_naziv_izvestaja: $("#TAB_STAVKE_DD_NAZIV_IZVESTAJA_UNOS2").val(),
        dd_web_servis: $("#TAB_STAVKE_DD_WEB_SERVIS_UNOS2").val(),
        broj_taba: $("#TAB_STAVKE_BR_TABA_UNOS2").val(),
        web_servis: $("#TAB_STAVKE_WEB_SERVIS_UNOS2").val(),
        serija4_naziv: $("#TAB_SERIJA4_NAZIV_UNOS2").val(),
        serija5_naziv: $("#TAB_SERIJA5_NAZIV_UNOS2").val(),
        dd_stavka: $("#TAB_DD_STAVKA_UNOS2").val(),
        dd_grafik: $("#TAB_DD_GRAFIK_UNOS2").val(),
        dd_br_serija: $("#TAB_DD_BR_SERIJA_UNOS2").val(),
        dd_serija1_naziv: $("#TAB_DD_SERIJA1_NAZIV_UNOS2").val(),
        dd_serija2_naziv: $("#TAB_DD_SERIJA2_NAZIV_UNOS2").val(),
        dd_serija3_naziv: $("#TAB_DD_SERIJA3_NAZIV_UNOS2").val(),
        dd_serija4_naziv: $("#TAB_DD_SERIJA4_NAZIV_UNOS2").val(),
        dd_serija5_naziv: $("#TAB_DD_SERIJA5_NAZIV_UNOS2").val(),
        jezik : $("#TAB_STAVKE_JEZIK_PRIMENE").val()
              
            },function(result){
                   console.log(result);
                    tblTaboviStavke.ajax.reload();
                    tblTaboviStavke_en.ajax.reload();
                    $('#modalUnosTabStavke').modal('toggle');

          
            });
        });
        $('#tabStavkeIzmena').click(function(){
         
    $.get("tabStavkeIzmena",{
        aplikacija: $('#TAB_STAVKE_APLIKACIJE_UNOS').val(),
        stavka: $("#TAB_STAVKE_STAVKA_UNOS").val(),
        grafik: $("#TAB_STAVKE_GRAFIK_UNOS").val(),
        broj_serija: $("#TAB_STAVKE_BROJ_SERIJA_UNOS").val(),
        serija1_naziv: $("#TAB_STAVKE_SERIJA1_NAZIV_UNOS").val(),
        serija2_naziv: $("#TAB_STAVKE_SERIJA2_NAZIV_UNOS").val(),
        serija3_naziv: $("#TAB_STAVKE_SERIJA3_NAZIV_UNOS").val(),
        naziv_isvestaja: $("#TAB_STAVKE_NAZIV_IZVESTAJA_UNOS").val(),
        dd_naziv_izvestaja: $("#TAB_STAVKE_DD_NAZIV_IZVESTAJA_UNOS").val(),
        dd_web_servis: $("#TAB_STAVKE_DD_WEB_SERVIS_UNOS").val(),
        broj_taba: $("#TAB_STAVKE_BR_TABA_UNOS").val(),
        web_servis: $("#TAB_STAVKE_WEB_SERVIS_UNOS").val(),
        serija4_naziv: $("#TAB_SERIJA4_NAZIV_UNOS").val(),
        serija5_naziv: $("#TAB_SERIJA5_NAZIV_UNOS").val(),
        dd_stavka: $("#TAB_DD_STAVKA_UNOS").val(),
        dd_grafik: $("#TAB_DD_GRAFIK_UNOS").val(),
        dd_br_serija: $("#TAB_DD_BR_SERIJA_UNOS").val(),
        dd_serija1_naziv: $("#TAB_DD_SERIJA1_NAZIV_UNOS").val(),
        dd_serija2_naziv: $("#TAB_DD_SERIJA2_NAZIV_UNOS").val(),
        dd_serija3_naziv: $("#TAB_DD_SERIJA3_NAZIV_UNOS").val(),
        dd_serija4_naziv: $("#TAB_DD_SERIJA4_NAZIV_UNOS").val(),
        dd_serija5_naziv: $("#TAB_DD_SERIJA5_NAZIV_UNOS").val(),
        jezik: $("#TAB_STAVKE_JEZIK_PRIMENE").val()
              
            },function(result){
                  console.log(result);
                    tblTaboviStavke.ajax.reload();
                     tblTaboviStavke_en.ajax.reload();

                    $('#modalUnosTabStavke').modal('toggle');

          
            });
        });
        var meniBrisanjeMeni = '';
        var aplikacijeBrisanjeAplikacija = '';
        $('#btnBrisanjeMeni').click(function(){
        // alert(tabStavkeBrisanjeAplikacija+tabStavkeBrisanjeBroj);
        if (meniBrisanjeMeni == ''){
            alert('Nije selektovan meni!!!');
            return false;
        }
    $.get("meniBrisanje",{

        meni: meniBrisanjeMeni
      //  tab_br: tabBrisanjeBroj
              
            },function(result){
                  
                tblMeniji.ajax.reload();
                   
            });
        });
        $('#btnBrisanjeAplikacije').click(function(){
        // alert(tabStavkeBrisanjeAplikacija+tabStavkeBrisanjeBroj);
        if (aplikacijeBrisanjeAplikacija == ''){
            alert('Nije selektovana aplikacija!!!');
            return false;
        }
    $.get("aplikacijeBrisanje",{

        aplikacija: aplikacijeBrisanjeAplikacija
      //  tab_br: tabBrisanjeBroj
              
            },function(result){
                  
                tblAplikacije.ajax.reload();
                   tblAplikacije_en.ajax.reload();
                   
            });
        });
        var tabBrisanjeAplikacija='';
        var tabBrisanjeBroj='';
        $('#btnBrisanjeTaba').click(function(){
        // alert(tabStavkeBrisanjeAplikacija+tabStavkeBrisanjeBroj);
        if (tabBrisanjeAplikacija == '' || tabBrisanjeBroj==''){
            alert('Nije selektovan tab!!!');
            return false;
        }
    $.get("tabBrisanje",{

        aplikacija: tabBrisanjeAplikacija,
        tab_id: tabBrisanjeID
              
            },function(result){
                  
                tblTabovi.ajax.reload();
                   
            });
        });
           $('#btnBrisanjeStavkeTaba').click(function(){
        // alert(tabStavkeBrisanjeAplikacija+tabStavkeBrisanjeBroj);
        if (tabStavkeBrisanjeAplikacija == '' || tabStavkaStavkaUnos==''){
            alert('Nije selektovana stavka!!!');
            return false;
        }
    $.get("tabStavkaBrisanje",{

        aplikacija: tabStavkeBrisanjeAplikacija,
        stavka: tabStavkaStavkaUnos,
        jezik: $('#TAB_STAVKE_JEZIK_PRIMENE').val()
              
            },function(result){
                  //  alert(result);
                tblTaboviStavke.ajax.reload();
                tblTaboviStavke_en.ajax.reload();
                   
            });
        });
        $('#tabUnos').click(function(){
         
        $.get("tabUnos",{
                // tab_id: $('#TAB_ID_UNOS2').val(),
                tab_br: $("#TAB_BR_UNOS2").val(),
                tab_naziv: $("#TAB_NAZIV_UNOS2").val(),
                and_aplikacije_pk: $("#TAB_AND_APLIKACIJE_PK_UNOS2").val()
              
            },function(result){
                    alert(result);
                    tblTabovi.ajax.reload();
                    $('#modalUnosTaba').modal('toggle');
                    popuniSelectTabovi();

          
            });
        });
         $('#tabIzmena').click(function(){
           // alert($('#selektovaniRed').text())
        $.get("tabIzmena",{
                tab_id: $('#TAB_ID_UNOS').val(),
                tab_br: $("#TAB_BR_UNOS").val(),
                tab_naziv: $("#TAB_NAZIV_UNOS").val(),
                and_aplikacije_pk: $("#TAB_AND_APLIKACIJE_PK_UNOS").val()
               
            },function(result){
                  
                    tblTabovi.ajax.reload();
                    $('#modalUnosTaba').modal('toggle');
                    popuniSelectTabovi();


          
            });
        });
         $('#aplikacijaUnos').click(function(){
         
        $.get("aplikacijaUnos",{
                aplikacija: $('#APP_NAZIV_UNOS2').val(),
                prikazni_naziv: $("#APP_PRIKAZNI_NAZIV_UNOS2").val(),
                android_maska: $("#APP_ANDROID_MASKA_UNOS2").val(),
                ws_parametar: $("#APP_WS_PARAMETAR_UNOS2").val(),
                ws_parametar2: $("#APP_WS_PARAMETAR2_UNOS2").val(),
                snack_poruka_do: $("#APP_SNACK_PORUKA_DO_UNOS2").val(),
                podsistem: $("#APP_MENI_UNOS2").val(),
                jezik: $("#APP_JEZIK_UNOS").val()

            },function(result){
                   // alert(result);
                    tblAplikacije.ajax.reload();
                     tblAplikacije_en.ajax.reload();
                    $('#modalUnosAplikacije').modal('toggle');
                    popuniSelectAplikacije();

          
            });
        });
         $('#aplikacijaIzmena').click(function(){
           // alert($('#selektovaniRed').text())
        $.get("aplikacijaIzmena",{
                aplikacija: $('#APP_NAZIV_UNOS').val(),
                prikazni_naziv: $("#APP_PRIKAZNI_NAZIV_UNOS").val(),
                android_maska: $("#APP_ANDROID_MASKA_UNOS").val(),
                ws_parametar: $("#APP_WS_PARAMETAR_UNOS").val(),
                ws_parametar2: $("#APP_WS_PARAMETAR2_UNOS").val(),
                snack_poruka_do: $("#APP_SNACK_PORUKA_DO_UNOS").val(),
                podsistem: $("#APP_MENI_UNOS").val(),
                jezik: $("#APP_JEZIK_UNOS").val()
              
             
            },function(result){
                    console.log(result);
                    tblAplikacije.ajax.reload();
                    tblAplikacije_en.ajax.reload();
                    $('#modalUnosAplikacije').modal('toggle');
                    popuniSelectAplikacije();

          
            });
        });
         $('#meniUnos').click(function(){
           // alert($('#selektovaniRed').text())
        $.get("meniUnos",{
                naziv: $('#MENI_NAZIV_UNOS2').val(),
                prikazni_naziv: $("#MENI_PRIKAZNI_NAZIV_UNOS2").val(),
                redosled: $("#MENI_REDOSLED_UNOS2").val()
              
             
            },function(result){
                    //alert(result);
                    tblMeniji.ajax.reload();
                    $('#modalUnosMeni').modal('toggle');
                    popuniSelectMeniji();

          
            });
        });
         $('#meniIzmena').click(function(){
           // alert($('#selektovaniRed').text())
        $.get("meniIzmena",{
                naziv: $('#MENI_NAZIV_UNOS').val(),
                prikazni_naziv: $("#MENI_PRIKAZNI_NAZIV_UNOS").val(),
                redosled: $("#MENI_REDOSLED_UNOS").val()
              
             
            },function(result){
                   
                    tblMeniji.ajax.reload();
                    $('#modalUnosMeni').modal('toggle');
                    popuniSelectMeniji();

          
            });
        });
             function popuniSelectMeniji()

            {
                //alert($('#selektovaniRed').text());
                $.get("androidMeniji",{
                korisnik: $('#selektovaniRed').text(),
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#APP_MENI_UNOS").empty();
                        $("#APP_MENI_UNOS2").empty();
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#APP_MENI_UNOS").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].naziv)
                                                        .val(obj[i].naziv)
                                                   ); 
                                                    $("#APP_MENI_UNOS2").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].naziv)
                                                        .val(obj[i].naziv)
                                                   );    
                        }

                  });
               
        

            }
             function popuniSelectAplikacije()

            {
                //alert($('#selektovaniRed').text());
                $.get("androidSveAPlikacije",{
            },function(result){
                
                obj = JSON.parse(result);

                var brRedova=obj.length;
               
                        $("#TAB_AND_APLIKACIJE_PK_UNOS").empty();
                        $("#TAB_STAVKE_APLIKACIJE_UNOS").empty();

                        $("#TAB_STAVKE_APLIKACIJE_UNOS2").empty();
                        $("#TAB_AND_APLIKACIJE_PK_UNOS2").empty();
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#TAB_AND_APLIKACIJE_PK_UNOS").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].aplikacija)
                                                        .val(obj[i].aplikacija)
                                                   );   
                                $("#TAB_AND_APLIKACIJE_PK_UNOS2").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].aplikacija)
                                                        .val(obj[i].aplikacija)
                                                   );   
                                $("#TAB_STAVKE_APLIKACIJE_UNOS").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].aplikacija)
                                                        .val(obj[i].aplikacija)
                                                   );   

                                $("#TAB_STAVKE_APLIKACIJE_UNOS2").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].aplikacija)
                                                        .val(obj[i].aplikacija)
                                                   );   
                        }

                  });
               
        

            }
            function popuniSelectTabovi()

            {
                //alert($('#selektovaniRed').text());
                $.get("androidSviTabovi",{
            },function(result){
                
                obj = JSON.parse(result);

                var brRedova=obj.length;
                        $("#TAB_STAVKE_BR_TABA_UNOS").empty();
                        
                        $("#TAB_STAVKE_BR_TABA_UNOS2").empty();
                        
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#TAB_STAVKE_BR_TABA_UNOS").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].tab_br)
                                                        .val(obj[i].tab_br)
                                                   );   

                                 $("#TAB_STAVKE_BR_TABA_UNOS2").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].tab_br)
                                                        .val(obj[i].tab_br)
                                                   );   
                               
                        }

                  });
               
        

            }
            popuniSelectTabovi();
            popuniSelectAplikacije();
            popuniSelectMeniji();

     </script>

     <script>
        var tblMeniji = $('#tblMeniji').DataTable({
     
                scrollY: "17vh",
                paging: false,
                 
                serverSide: false,
                scrollX: true,
                select:true,
                searching:false,
                ajax:{
                    url:  "{{ route('androidMeniji') }}",
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },
                columns:[
                        { data: 'naziv' },
                        { data: 'prikazni_naziv' },
                        { data: 'redosled' }
                       
                   
                        ]
        });
        var meniPrikazniNaziv = '';
        var meniRedosled = '';
        var selektovaniMeni= '';
        $('#tblMeniji tbody').on('click','tr',function(event){

            selektovaniMeni = $(this).find('td').eq($('#tblSelMeniNaziv').index()).html();
            $('#prikaziSetMenijaTekst').text('->'+selektovaniMeni);
            $('#prikaziSetAplikacijaTekst').text('');
            meniBrisanjeMeni = $(this).find('td').eq(0).html();
            $('#APP_MENI_UNOS').val(selektovaniMeni);

            // popuni polja modala
                meniPrikazniNaziv = $(this).find('td').eq(1).html();
                meniRedosled = $(this).find('td').eq(2).html();
            // 

            $("#selektovaniMeni").text(selektovaniMeni).show();

            if (pickedupMeni != null) {
                              pickedupMeni.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#B0BED9" );
                          pickedupMeni = $( this );

             urlAplikacije = '{{ route('androidAplikacije', ['meni' =>':meni','jezik' =>':jezik']) }}';

                        urlAplikacije = urlAplikacije.replace(':meni', selektovaniMeni);
                    urlAplikacije = urlAplikacije.replace(':jezik', $('#APP_JEZIK_UNOS').val());
                                    tblAplikacije.ajax.url(urlAplikacije).load();


                                    $("#modIzmeniMeni").trigger('click');
        
            });
        urlAplikacije = "{{ route('androidAplikacije', ['meni' =>'n','jezik' =>'SRB']) }}";
        $('#tblAplikacije_enD').hide();
        $('#APP_JEZIK_UNOS').change(function(){
            urlAplikacije = '{{ route('androidAplikacije', ['meni' =>':meni','jezik' =>':jezik']) }}';

                        urlAplikacije = urlAplikacije.replace(':meni', selektovaniMeni);
                    urlAplikacije = urlAplikacije.replace(':jezik', $('#APP_JEZIK_UNOS').val());
                                   
            if ($('#APP_JEZIK_UNOS').val()=='SRB')
            {
                $('#tblAplikacije_enD').hide();
                $('#tblAplikacijeD').show();

                 tblAplikacije.ajax.url(urlAplikacije).load();
            }
            else
            {
                $('#tblAplikacije_enD').show();
                $('#tblAplikacijeD').hide();

                 tblAplikacije_en.ajax.url(urlAplikacije).load();
            }
        })
        var tblAplikacije = $('#tblAplikacije').DataTable({
     
                scrollY: "17vh",
                paging: false,
                scrollX: true,
               // "autoWidth": false,
                //scrollCollapse: true,
                select:true,
                searching:false,
        
                ajax:{
                    url:  urlAplikacije,
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },
                columns:[
                        { data: 'aplikacija' },
                        { data: 'prikazni_naziv' },
                        { data: 'android_maska' },
                        { data: 'podsistem' },
                        { data: 'ws_parametar' },
                        { data: 'ws_parametar2' },
                        { data: 'snack_poruka_do' },
                       
                   
                        ]
        });
        var tblAplikacije_en = $('#tblAplikacije_en').DataTable({
     
                scrollY: "17vh",
                paging: false,
                scrollX: true,
               // "autoWidth": false,
                //scrollCollapse: true,
                select:true,
                searching:false,
        
                ajax:{
                    url:  urlAplikacije,
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },
                columns:[
                        { data: 'aplikacija' },
                        { data: 'prikazni_naziv' },
                         { data: 'jezik' }
                       
                       
                   
                        ]
        });
        var selektovanaAplikacija = '';
        var appPrikazniNaziv = '';
        var appAndroidMaska = '';
        var appWsParametar = '';
        var appWsParametar2 = '';
        var appSnackPorukaDo = '';
        var appMeni = '';
        $('#tblAplikacije tbody').on('click','tr',function(event){

            selektovanaAplikacija = $(this).find('td').eq($('#tblSelAplikacijaNaziv').index()).html();
            aplikacijeBrisanjeAplikacija = $(this).find('td').eq(0).html();
            $('#prikaziSetAplikacijaTekst').text('->'+selektovanaAplikacija);
            $('#prikaziSetTabovaTekst').text('');
            $('#TAB_AND_APLIKACIJE_PK_UNOS').val(selektovanaAplikacija);
            $('#TAB_STAVKE_APLIKACIJE_UNOS').val(selektovanaAplikacija);
            $("#selektovanaAplikacija").text(selektovanaAplikacija).show();

            // popuni polja modala
                appPrikazniNaziv = $(this).find('td').eq(1).html();
                appAndroidMaska = $(this).find('td').eq(2).html();
                appWsParametar = $(this).find('td').eq(4).html();
                appWsParametar2 = $(this).find('td').eq(5).html();
                appSnackPorukaDo = $(this).find('td').eq(6).html();
                appMeni = $(this).find('td').eq(3).html();
           
            //

            if (pickedupAplikacije != null) {
                              pickedupAplikacije.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#B0BED9" );
                          pickedupAplikacije = $( this );

            urlTab = '{{ route('androidTabovi', ['aplikacija' =>':aplikacija']) }}';

                        urlTab = urlTab.replace(':aplikacija', selektovanaAplikacija);
                                    tblTabovi.ajax.url(urlTab).load();
            $("#modIzmeniAplikaciju").trigger('click');
        
            });


            $('#tblAplikacije_en tbody').on('click','tr',function(event){

            selektovanaAplikacija = $(this).find('td').eq($('#tblSelAplikacijaNaziv_en').index()).html();
            aplikacijeBrisanjeAplikacija = $(this).find('td').eq(0).html();
            $('#prikaziSetAplikacijaTekst').text('->'+selektovanaAplikacija);
            $('#prikaziSetTabovaTekst').text('');
            $('#TAB_AND_APLIKACIJE_PK_UNOS').val(selektovanaAplikacija);
            $('#TAB_STAVKE_APLIKACIJE_UNOS').val(selektovanaAplikacija);
            $("#selektovanaAplikacija").text(selektovanaAplikacija).show();

            // popuni polja modala
                appPrikazniNaziv = $(this).find('td').eq(1).html();
           
            //

            if (pickedupAplikacije != null) {
                              pickedupAplikacije.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#B0BED9" );
                          pickedupAplikacije = $( this );

            urlTab = '{{ route('androidTabovi', ['aplikacija' =>':aplikacija']) }}';

                        urlTab = urlTab.replace(':aplikacija', selektovanaAplikacija);
                                    tblTabovi.ajax.url(urlTab).load();
           modIzmeniAplikaciju_en();
        
            });

              urlTab = "{{ route('androidTabovi', ['aplikacija' =>'n']) }}"
        var tblTabovi = $('#tblTabovi').DataTable({
     
                scrollY: "17vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,
                ajax:{
                    url:  urlTab,
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },
                columns:[
                        { data: 'tab_id' },
                        { data: 'tab_br' },
                        { data: 'tab_naziv' },
                        { data: 'and_aplikacije_pk' }
                   
                        ]
        });
        var tabId = '';
        var tabNaziv = '';
        var selektovaniTab= '';
        $('#tblTabovi tbody').on('click','tr',function(event){

            selektovaniTab = $(this).find('td').eq($('#tblSelTabNaziv').index()).html();
            tabBrisanjeAplikacija = $(this).find('td').eq(3).html();

            $('#prikaziSetTabovaTekst').text('->'+selektovaniTab);
            $('#prikaziSetStavkiTekst').text('');

            tabBrisanjeBroj = $(this).find('td').eq(1).html();
            tabBrisanjeID = $(this).find('td').eq(0).html();
            $('#TAB_STAVKE_BR_TABA_UNOS').val(selektovaniTab);
            $("#selektovaniTab").text(selektovaniTab).show();

             // popuni polja modala
                tabId = $(this).find('td').eq(0).html();
                tabNaziv = $(this).find('td').eq(2).html();
              
           
            //

            if (pickedupTab != null) {
                              pickedupTab.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#B0BED9" );
                          pickedupTab = $( this );

            urlTabStavka = '{{ route('androidTaboviStavke', ['aplikacija' =>':aplikacija','br_taba' =>':br_taba','jezik' =>':jezik']) }}';

                        urlTabStavka = urlTabStavka.replace(':aplikacija', selektovanaAplikacija);
                        urlTabStavka = urlTabStavka.replace(':br_taba', selektovaniTab);
        urlTabStavka = urlTabStavka.replace(':jezik', $('#TAB_STAVKE_JEZIK_PRIMENE').val());
                                    tblTaboviStavke.ajax.url(urlTabStavka).load();
                                    $("#modIzmenaTaba").trigger('click');
        
        
        
            });
         urlTabStavka = "{{ route('androidTaboviStavke', ['aplikacija' =>'n','br_taba' =>'9999','jezik' =>'SRB']) }}";
         $('#TAB_STAVKE_JEZIK_PRIMENE').change(function(){
             urlTabStavka = '{{ route('androidTaboviStavke', ['aplikacija' =>':aplikacija','br_taba' =>':br_taba','jezik' =>':jezik']) }}';

                        urlTabStavka = urlTabStavka.replace(':aplikacija', selektovanaAplikacija);
                        urlTabStavka = urlTabStavka.replace(':br_taba', selektovaniTab);
        urlTabStavka = urlTabStavka.replace(':jezik', $('#TAB_STAVKE_JEZIK_PRIMENE').val());
            if ($('#TAB_STAVKE_JEZIK_PRIMENE').val()=='SRB')
            {   
                alert(urlTabStavka);
                $('#tblTaboviStavke_enD').hide();
                $('#tblTaboviStavkeD').show();
                 tblTaboviStavke.ajax.url(urlTabStavka).load();
            }
            else
            {
                
                $('#tblTaboviStavke_enD').show();
                $('#tblTaboviStavkeD').hide();
                 tblTaboviStavke_en.ajax.url(urlTabStavka).load();
            }
           
         });
         $('#tblTaboviStavke_enD').hide();
         var tblTaboviStavke = $('#tblTaboviStavke').DataTable({
     
                scrollY: "17vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,
                ajax:{
                    url: '{{ route('androidTabovi', ['aplikacija' =>'Administracij']) }}',
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },
                columns:[
                        { data: 'aplikacija' },
                        { data: 'stavka' },
                        { data: 'broj_taba' },
                        { data: 'grafik' },
                        { data: 'broj_serija' },
                        { data: 'serija1_naziv' },
                        { data: 'serija2_naziv' },
                        { data: 'serija3_naziv' },
                        { data: 'naziv_isvestaja' },

                        { data: 'web_servis' },
                        { data: 'serija4_naziv' },
                        { data: 'serija5_naziv' },
                        { data: 'dd_stavka' },
                        { data: 'dd_grafik' },
                        { data: 'dd_br_serija' },
                        { data: 'dd_serija1_naziv' },
                        { data: 'dd_serija2_naziv' },
                        { data: 'dd_serija3_naziv' },
                        { data: 'dd_serija4_naziv' },
                        { data: 'dd_serija5_naziv' },
                        { data: 'dd_naziv_izvestaja' },
                        { data: 'dd_web_servis' }
                
                                     
                        ],
                         columnDefs: [{
                                            data: null,
                                            defaultContent: '',
                                            targets: "_all"
                                    }]
        });
         var tblTaboviStavke_en = $('#tblTaboviStavke_en').DataTable({
     
                scrollY: "17vh",
                paging: false,
                scrollX: true,
                select:true,
                searching:false,
                ajax:{
                    url: '{{ route('androidTabovi', ['aplikacija' =>'Administracij']) }}',
                        "type": "GET",
                        data:function(){
                          //id:1
                                       },
                        dataSrc: ''
                    },
                columns:[
                        { data: 'aplikacija' },
                        { data: 'stavka' },
                     
                       
                  
                        { data: 'serija1_naziv' },
                        { data: 'serija2_naziv' },
                        { data: 'serija3_naziv' },
                        { data: 'naziv_isvestaja' },

                        { data: 'serija4_naziv' },
                        { data: 'serija5_naziv' },
                     
               
                        { data: 'dd_serija1_naziv' },
                        { data: 'dd_serija2_naziv' },
                        { data: 'dd_serija3_naziv' },
                        { data: 'dd_serija4_naziv' },
                        { data: 'dd_serija5_naziv' },
                        { data: 'dd_naziv_izvestaja' },
                        { data: 'jezik' }

                                     
                        ],
                         columnDefs: [{
                                            data: null,
                                            defaultContent: '',
                                            targets: "_all"
                                    }]
        });


         var tabStavkeBrisanjeAplikacija = '';
         var tabStavkeBrisanjeBroj = '';
        // var tabStavkeBrisanjeStavka = '';

         var pickedupTabStavka;
         $('#tblTaboviStavke tbody').on('click','tr',function(event){



            tabStavkeBrisanjeAplikacija = $(this).find('td').eq(0).html();
            tabStavkeBrisanjeBroj = $(this).find('td').eq(2).html();

            $('#prikaziSetStavkiTekst').text('->'+$(this).find('td').eq(1).html());

            //$('#uspesnostTabStavka').load();
            // popuni polja modala
            tabStavkaStavkaUnos = $(this).find('td').eq(1).html();
            tabStavkaGrafikUnos = $(this).find('td').eq(3).html();
            tabStavkaBrojSerijaUnos = $(this).find('td').eq(4).html();
            tabStavkaSerija1NazivUnos = $(this).find('td').eq(5).html();
            tabStavkaSerija2NazivUnos = $(this).find('td').eq(6).html();
            tabStavkaSerija3NazivUnos = $(this).find('td').eq(7).html();
            tabStavkaNazivIsvestajaUnos = $(this).find('td').eq(8).html();
            tabStavkaWebServisUnos = $(this).find('td').eq(9).html();
            tabStavkaSerija4NazivUnos = $(this).find('td').eq(10).html();
            tabStavkaSerija5NazivUnos = $(this).find('td').eq(11).html();
            tabStavkaDDStavkaUnos = $(this).find('td').eq(12).html();
            tabStavkaDDGrafikUnos = $(this).find('td').eq(13).html();
            tabStavkaDdBrSerijaUnos = $(this).find('td').eq(14).html();
            tabStavkaDdSerija1NazivUnos = $(this).find('td').eq(15).html();
            tabStavkaDdSerija2NazivUnos = $(this).find('td').eq(16).html();
            tabStavkaDdSerija3NazivUnos = $(this).find('td').eq(17).html();
            tabStavkaDdSerija4NazivUnos = $(this).find('td').eq(18).html();
            tabStavkaDdSerija5NazivUnos = $(this).find('td').eq(19).html();
            tabStavkaDDNazivIzvestaja = $(this).find('td').eq(20).html();
            tabStavkaDdWebServis = $(this).find('td').eq(21).html();
                
                
           
            //

            if (pickedupTabStavka != null) {
                              pickedupTabStavka.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#B0BED9" );
                          pickedupTabStavka = $( this );
        
         $("#modIzmeniStavkuTaba").trigger('click');
            });



         function modIzmeniStavkuTaba_en(){
            // $('#tabStavkeUnos').hide();
            // $('#tabStavkeIzmena').show();

        if (tabStavkeBrisanjeAplikacija=='')
            {
                alert('Niste selektovali stavku za izmenu!!!!');
                // $('#modalUnosMeni').modal('toggle');
                e.stopPropagation();//ne otvaraj modal ako nije red selektovan
            }
           
            $('#TAB_STAVKE_APLIKACIJE_UNOS').prop('disabled', true);
            $('#TAB_STAVKE_BR_TABA_UNOS').prop('disabled', true);

            $('#TAB_STAVKE_APLIKACIJE_UNOS').val(tabStavkeBrisanjeAplikacija);
            $('#TAB_STAVKE_STAVKA_UNOS').val(tabStavkaStavkaUnos);
            //$('#TAB_STAVKE_GRAFIK_UNOS').val(tabStavkaGrafikUnos);
            //$('#TAB_STAVKE_BROJ_SERIJA_UNOS').val(tabStavkaBrojSerijaUnos);
            $('#TAB_STAVKE_SERIJA1_NAZIV_UNOS').val(tabStavkaSerija1NazivUnos);
            $('#TAB_STAVKE_SERIJA2_NAZIV_UNOS').val(tabStavkaSerija2NazivUnos);
            $('#TAB_STAVKE_SERIJA3_NAZIV_UNOS').val(tabStavkaSerija3NazivUnos);
            $('#TAB_STAVKE_NAZIV_IZVESTAJA_UNOS').val(tabStavkaNazivIsvestajaUnos);
            $('#TAB_STAVKE_DD_NAZIV_IZVESTAJA_UNOS').val(tabStavkaDDNazivIzvestaja);
            //$('#TAB_STAVKE_DD_WEB_SERVIS_UNOS').val(tabStavkaDdWebServis);
            //$('#TAB_STAVKE_WEB_SERVIS_UNOS').val(tabStavkaWebServisUnos);
            $('#TAB_SERIJA4_NAZIV_UNOS').val(tabStavkaSerija4NazivUnos);
            $('#TAB_SERIJA5_NAZIV_UNOS').val(tabStavkaSerija5NazivUnos);
            //$('#TAB_DD_STAVKA_UNOS').val(tabStavkaDDStavkaUnos);
            //$('#TAB_DD_GRAFIK_UNOS').val(tabStavkaDDGrafikUnos);
           // $('#TAB_DD_BR_SERIJA_UNOS').val(tabStavkaDdBrSerijaUnos);
            $('#TAB_DD_SERIJA1_NAZIV_UNOS').val(tabStavkaDdSerija1NazivUnos);
            $('#TAB_DD_SERIJA2_NAZIV_UNOS').val(tabStavkaDdSerija2NazivUnos);
            $('#TAB_DD_SERIJA3_NAZIV_UNOS').val(tabStavkaDdSerija3NazivUnos);
            $('#TAB_DD_SERIJA4_NAZIV_UNOS').val(tabStavkaDdSerija4NazivUnos);
            $('#TAB_DD_SERIJA5_NAZIV_UNOS').val(tabStavkaDdSerija5NazivUnos);
           
            
        };


          $('#tblTaboviStavke_en tbody').on('click','tr',function(event){



            tabStavkeBrisanjeAplikacija = $(this).find('td').eq(0).html();
            //tabStavkeBrisanjeBroj = $(this).find('td').eq(2).html();

            $('#prikaziSetStavkiTekst').text('->'+$(this).find('td').eq(1).html());

            //$('#uspesnostTabStavka').load();
            // popuni polja modala
            tabStavkaStavkaUnos = $(this).find('td').eq(1).html();
           // tabStavkaGrafikUnos = $(this).find('td').eq(3).html();
            //tabStavkaBrojSerijaUnos = $(this).find('td').eq(4).html();
            tabStavkaSerija1NazivUnos = $(this).find('td').eq(2).html();
            tabStavkaSerija2NazivUnos = $(this).find('td').eq(3).html();
            tabStavkaSerija3NazivUnos = $(this).find('td').eq(4).html();
            tabStavkaNazivIsvestajaUnos = $(this).find('td').eq(5).html();
            //tabStavkaWebServisUnos = $(this).find('td').eq(9).html();
            tabStavkaSerija4NazivUnos = $(this).find('td').eq(6).html();
            tabStavkaSerija5NazivUnos = $(this).find('td').eq(7).html();
            //tabStavkaDDStavkaUnos = $(this).find('td').eq(12).html();
            //tabStavkaDDGrafikUnos = $(this).find('td').eq(13).html();
            //tabStavkaDdBrSerijaUnos = $(this).find('td').eq(14).html();
            tabStavkaDdSerija1NazivUnos = $(this).find('td').eq(8).html();
            tabStavkaDdSerija2NazivUnos = $(this).find('td').eq(9).html();
            tabStavkaDdSerija3NazivUnos = $(this).find('td').eq(10).html();
            tabStavkaDdSerija4NazivUnos = $(this).find('td').eq(11).html();
            tabStavkaDdSerija5NazivUnos = $(this).find('td').eq(12).html();
            tabStavkaDDNazivIzvestaja = $(this).find('td').eq(13).html();
            //tabStavkaDdWebServis = $(this).find('td').eq(21).html();
                
                
           
            //

            if (pickedupTabStavka != null) {
                              pickedupTabStavka.css( "background-color", "#ffffff" );
                          }
                          $( this ).css( "background-color", "#B0BED9" );
                          pickedupTabStavka = $( this );
      modIzmeniStavkuTaba_en();
       //  $("#modIzmeniStavkuTaba_en").trigger('click');
            });
            
     </script>

@stop