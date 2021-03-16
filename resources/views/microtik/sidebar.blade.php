<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Microtik Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    {{-- <link href="{{ asset("css/admin/all.min.css") }}" rel="stylesheet" type="text/css"> --}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset("css/admin/admin-2.css") }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset("js/admin/jquery.easing.js") }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset("js/admin/admin-2.js") }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset("js/admin/Chart.js") }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset("js/admin/chart-area-demo.js") }}"></script>
    <script src="{{ asset("js/admin/chart-pie-demo.js") }}"></script>

    @yield('styles')

</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route("home") }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-router"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Mikrotik System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-plus"></i>
                    <span>Add Router</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        
        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-0 text-gray-800">@yield('sectionHeading')</h1>
                        <p class="mb-0">@yield('sectionHeadingInfo')</p>
                    <div class="row">
                        {{-- <a href="" class=""> --}}
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12 m-0 ">
                                        
                                   {{-- First Router in the list --}}
                                    {{-- <div class="col-lg-12 pb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="icon-contain">
                                                    <div class="row">
                                                        <div class="col-8 align-self-center">
                                                            <a href="#" class="link-success"><h4 class="mb-3">Malaba Hotspot</h4></a>
                                                            <p class="h6 m-0 text-dark">Bungoma</p>
                                                            <p class="text-muted mb-0">Router-9b51g1 <i class="mdi mdi-menu-down text-danger font-16"></i></p>
                                                        </div><!--end col-->
                                                        <div class="col-4">
                                                            <span class="peity-line" data-width="100%" data-peity="{ &quot;fill&quot;: [&quot;#0dc8de24&quot;],&quot;stroke&quot;: [&quot;#0dc8de&quot;]}" data-height="50" style="display: none;">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                                            <svg class="peity" height="50" width="100%"><rect data-value="6" fill="#4d79f62b" x="0.608625" y="16.66666666666667" width="4.869" height="33.33333333333333"></rect><rect data-value="2" fill="#4d79f6" x="6.694875000000001" y="38.888888888888886" width="4.868999999999999" height="11.111111111111114"></rect><rect data-value="8" fill="#4d79f62b" x="12.781125" y="5.555555555555557" width="4.869" height="44.44444444444444"></rect><rect data-value="4" fill="#4d79f6" x="18.867375" y="27.77777777777778" width="4.869" height="22.22222222222222"></rect><rect data-value="3" fill="#4d79f62b" x="24.953624999999995" y="33.333333333333336" width="4.869000000000003" height="16.666666666666664"></rect><rect data-value="8" fill="#4d79f6" x="31.039874999999995" y="5.555555555555557" width="4.869000000000007" height="44.44444444444444"></rect><rect data-value="1" fill="#4d79f62b" x="37.126124999999995" y="44.44444444444444" width="4.869000000000007" height="5.555555555555557"></rect><rect data-value="3" fill="#4d79f6" x="43.212374999999994" y="33.333333333333336" width="4.869000000000007" height="16.666666666666664"></rect><rect data-value="6" fill="#4d79f62b" x="49.298624999999994" y="16.66666666666667" width="4.869000000000007" height="33.33333333333333"></rect><rect data-value="5" fill="#4d79f6" x="55.384875" y="22.22222222222222" width="4.869000000000007" height="27.77777777777778"></rect><rect data-value="9" fill="#4d79f62b" x="61.471124999999994" y="0" width="4.869000000000007" height="50"></rect><rect data-value="2" fill="#4d79f6" x="67.557375" y="38.888888888888886" width="4.869" height="11.111111111111114"></rect><rect data-value="8" fill="#4d79f62b" x="73.643625" y="5.555555555555557" width="4.869" height="44.44444444444444"></rect><rect data-value="1" fill="#4d79f6" x="79.72987499999999" y="44.44444444444444" width="4.869" height="5.555555555555557"></rect><rect data-value="4" fill="#4d79f62b" x="85.81612499999999" y="27.77777777777778" width="4.869000000000014" height="22.22222222222222"></rect><rect data-value="8" fill="#4d79f6" x="91.90237499999999" y="5.555555555555557" width="4.869000000000014" height="44.44444444444444"></rect><rect data-value="9" fill="#4d79f62b" x="97.988625" y="0" width="4.868999999999986" height="50"></rect><rect data-value="8" fill="#4d79f6" x="104.07487499999999" y="5.555555555555557" width="4.868999999999986" height="44.44444444444444"></rect><rect data-value="2" fill="#4d79f62b" x="110.161125" y="38.888888888888886" width="4.868999999999971" height="11.111111111111114"></rect><rect data-value="1" fill="#4d79f6" x="116.247375" y="44.44444444444444" width="4.868999999999986" height="5.555555555555557"></rect></svg>
                                                        </div><!--end col-->
                                                    </div>  <!--end row-->                                                      
                                                </div><!--end icon-contain-->
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div> --}}

                                    {{-- Second Router in the list --}}
                                    @foreach(\App\Models\MicroTik::all() as $microtik)
                                    <div class="col-lg-12 pb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="icon-contain">
                                                    <div class="row">
                                                        <div class="col-8 align-self-center">
                                                            <a href="{{route('router_auto_login', $microtik->id)}}"><h4 class="mb-3">{{$microtik->name}}</h4></a>
                                                            <p class="h6 m-0 text-dark">Kakamega</p>
                                                            <p class="text-muted mb-0">Router-{{$microtik->ip}} <i class="mdi mdi-menu-down text-danger font-16"></i></p>
                                                        </div><!--end col-->
                                                        <div class="col-4">
                                                            <span class="peity-line" data-width="100%" data-peity="{ &quot;fill&quot;: [&quot;#0dc8de24&quot;],&quot;stroke&quot;: [&quot;#0dc8de&quot;]}" data-height="50" style="display: none;">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                                            <svg class="peity" height="50" width="100%"><rect data-value="6" fill="#4d79f62b" x="0.608625" y="16.66666666666667" width="4.869" height="33.33333333333333"></rect><rect data-value="2" fill="#4d79f6" x="6.694875000000001" y="38.888888888888886" width="4.868999999999999" height="11.111111111111114"></rect><rect data-value="8" fill="#4d79f62b" x="12.781125" y="5.555555555555557" width="4.869" height="44.44444444444444"></rect><rect data-value="4" fill="#4d79f6" x="18.867375" y="27.77777777777778" width="4.869" height="22.22222222222222"></rect><rect data-value="3" fill="#4d79f62b" x="24.953624999999995" y="33.333333333333336" width="4.869000000000003" height="16.666666666666664"></rect><rect data-value="8" fill="#4d79f6" x="31.039874999999995" y="5.555555555555557" width="4.869000000000007" height="44.44444444444444"></rect><rect data-value="1" fill="#4d79f62b" x="37.126124999999995" y="44.44444444444444" width="4.869000000000007" height="5.555555555555557"></rect><rect data-value="3" fill="#4d79f6" x="43.212374999999994" y="33.333333333333336" width="4.869000000000007" height="16.666666666666664"></rect><rect data-value="6" fill="#4d79f62b" x="49.298624999999994" y="16.66666666666667" width="4.869000000000007" height="33.33333333333333"></rect><rect data-value="5" fill="#4d79f6" x="55.384875" y="22.22222222222222" width="4.869000000000007" height="27.77777777777778"></rect><rect data-value="9" fill="#4d79f62b" x="61.471124999999994" y="0" width="4.869000000000007" height="50"></rect><rect data-value="2" fill="#4d79f6" x="67.557375" y="38.888888888888886" width="4.869" height="11.111111111111114"></rect><rect data-value="8" fill="#4d79f62b" x="73.643625" y="5.555555555555557" width="4.869" height="44.44444444444444"></rect><rect data-value="1" fill="#4d79f6" x="79.72987499999999" y="44.44444444444444" width="4.869" height="5.555555555555557"></rect><rect data-value="4" fill="#4d79f62b" x="85.81612499999999" y="27.77777777777778" width="4.869000000000014" height="22.22222222222222"></rect><rect data-value="8" fill="#4d79f6" x="91.90237499999999" y="5.555555555555557" width="4.869000000000014" height="44.44444444444444"></rect><rect data-value="9" fill="#4d79f62b" x="97.988625" y="0" width="4.868999999999986" height="50"></rect><rect data-value="8" fill="#4d79f6" x="104.07487499999999" y="5.555555555555557" width="4.868999999999986" height="44.44444444444444"></rect><rect data-value="2" fill="#4d79f62b" x="110.161125" y="38.888888888888886" width="4.868999999999971" height="11.111111111111114"></rect><rect data-value="1" fill="#4d79f6" x="116.247375" y="44.44444444444444" width="4.868999999999986" height="5.555555555555557"></rect></svg>
                                                        </div><!--end col-->
                                                    </div>  <!--end row-->                                                      
                                                </div><!--end icon-contain-->
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div>
                                    @endforeach

                                    </div>
                                    

                                </div>
                            </div>
                        {{-- </a> --}}
                        <div class="col-lg-8">
                            @yield('content')
                        </div>
                        
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    

</body>

</html>