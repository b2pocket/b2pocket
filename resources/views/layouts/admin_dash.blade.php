@extends('layouts.app')

@section('body')

{{-- @if(!Auth::check()) --}}
@if(!Auth::check())
    <script type="text/javascript">
      
    window.location = "{{ route('login') }}";//here double curly bracket
    </script>
@endif
 <!-- Page Wrapper -->
  <div id="wrapper" class="mojBody" >
  	
    <!-- Sidebar -->
	    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top " id="accordionSidebar" >
	    
	      <!-- Sidebar - Brand -->
	      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
	        <div class="sidebar-brand-icon rotate-n-15">
	          <i class="fas fa-chart-bar"></i>
	        </div>
	        <div class="sidebar-brand-text mx-3">B2ME <sup>PRO</sup></div>
	      </a>

	      <!-- Divider -->
	      <hr class="sidebar-divider my-0">

	      <!-- Nav Item - Dashboard -->
	      <li class="nav-item active">
	      	<a class="nav-link" href="{{ url ('/home') }}" ><i class="fas fa-home"></i>Pocetna</a>
	      </li>
	      <div>
	      	<div id="meniDiv" class="overflow-auto" ></div>
	      </div>
	    	

	      <!-- Divider -->
	      <hr class="sidebar-divider d-none d-md-block">


	    </ul>
  
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content " >

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 fixed-top shadow mojTopBar" id="idMojTopBar">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
         

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">@if(Auth::check()){{Auth::user()->name}}@endif</span>
                <img class="img-profile rounded-circle" src="https://cdn.pixabay.com/photo/2018/01/17/04/14/industry-3087393_960_720.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route ('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    </form>
              </div>
            
          
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <div class="row no-gutters" style="margin-top:  4.375rem;">
        				 <div class="row text-center m-auto">
                            <div class="text-center col-sm-12 col-md-12 col-lg-12 m-2">
                                <h1 class="page-header" style="font-size: calc(12px + (26 - 14) * ((100vw - 300px) / (1600 - 300)));">@yield('page_heading')</h1>
                            </div>
                <!-- /.col-lg-12 -->
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 justify-content-around" id="div_testiranje">
                        @yield('section')
                        </div>
        </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script>
         var url = '{{url('kreirajMeni')}}';
         // $.ajaxSetup({timeout:2000});
         // $.ajaxSetup({async: false});
  	  	 $.get(url,{
                //pretraga:param,
            		},function(result){
            	$("#meniDiv").empty();
               $("#meniDiv").append(result);
       	 			});
  </script>

@stop