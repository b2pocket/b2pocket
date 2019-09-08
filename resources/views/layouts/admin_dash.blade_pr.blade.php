@extends('layouts.app')

@section('body')

@if(!Auth::check())
    <script type="text/javascript">
    window.location = "{{ route('login') }}";//here double curly bracket
    </script>
@endif
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up" style="color: black;"></i></button>
    <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
              } else {
                document.getElementById("myBtn").style.display = "none";
              }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
              document.body.scrollTop = 0;
              document.documentElement.scrollTop = 0;
            }
</script>
    <div class="wrapper" style="width: 100%;">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>B2ME</h3>
                <strong>B2M</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                      <a href="{{ url ('/home') }}" ><i class="fas fa-home"></i>Pocetna</a>
                </li>
                <li>
          
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        {{-- <i class="fas fa-copy"></i> --}}
                        <i class="fab fa-android"></i>
                        Android
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li id="zatvoriSidebar">
                            <a  href="{{ url ('korisnici_i_prava') }}">Registracija korisnika androida</a>
                        </li>
                        <li id="zatvoriSidebar">
                            <a  href="{{ url ('aplikacijeIndex') }}">Android aplikacije</a>
                        </li>
                      
                    </ul>
               
                    {{-- Kraj meni setovanja --}}

                </li>
                <li>
                            <a  href="{{ url ('zapisiIndex') }}"> <i class="fas fa-laptop-code"></i>Zapisi</a>
            
                </li>


                <li>
          
                   <div class="btn-group dropright">
                     <a  data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle"  aria-haspopup="true">
                        {{-- <i class="fas fa-copy"></i> --}}
                        <i class="fab fa-android"></i>
                        Android
                    </a>
                      <div class="dropdown-menu">
                        
                                {{-- <li class="dropdown-item"  id="zatvoriSidebar"> --}}
                                    <a class="dropdown-item"  href="{{ url ('korisnici_i_prava') }}">Registracija korisnika androida</a>
                                {{-- </li> --}}
                                {{-- <li class="dropdown-item"  id="zatvoriSidebar"> --}}
                                    <a class="dropdown-item"  href="{{ url ('aplikacijeIndex') }}">Android aplikacije</a>
                                {{-- </li> --}}
                              
                  
                      </div>
                    </div>


                </li>


            </ul>
        </nav>



        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                       <div class="row text-center m-auto">
                            <div class="text-center col-sm-12 col-md-12 col-lg-12 m-2">
                                <h1 class="page-header" style="font-size: calc(12px + (26 - 14) * ((100vw - 300px) / (1600 - 300)));">@yield('page_heading')</h1>
                            </div>
                <!-- /.col-lg-12 -->
                        </div>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto text-right">
                            <li class="nav-item active">
                            <a class="btn btn-info btn-md mt-2" href="{{ route ('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>LOGOUT</a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    </form>
                                {{-- <a class="nav-link" href="#">Page</a> --}}
                            </li>
                       
                        </ul>
                    </div>
                </div>
            </nav>

                    <div class="row no-gutters">
                        <div class="col-sm-12 col-md-12 col-lg-12 justify-content-around" id="div_testiranje">
                        @yield('section')
                        </div>
                    </div>
                  
                    <!-- /#page-wrapper -->
                {{-- </div> --}}


        </div>
    </div>

       

        <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
               // $('.table').DataTable().ajax.reload();
                $('.tblZapisi').ajax.reload();

//tblZapisi
                // $('#div_testiranje').width('50%');
            });


        });
    </script>

@stop

