<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Styles -->
    @yield('css')
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Archivo Municipal</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#">{{Auth::user()->name}}</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('menu')}}">
                                <i class="las la-home fs-4"></i>
                                Inicio
                            </a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('direccion')}}">
                                <i class="las la-sitemap fs-4"></i>
                                Direcciones
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('coordinacion')}}">
                                <i class="las la-globe fs-4"></i>
                                Coordinaciones
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('archivo')}}">
                                <i class="las la-archive fs-4"></i>
                                Archivo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('perfil')}}">
                                <i class="las la-user-cog fs-4"></i>
                                Usuarios
                            </a>
                        </li>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Reportes</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('reporte.general')}}">
                                <i class="las la-file-alt fs-4"></i>
                                Reporte General
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('reporte.direccion')}}">
                                <i class="las la-file-alt fs-4"></i>
                                Reportes por dirección
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('reporte.coordinacion')}}">
                                <i class="las la-file-alt fs-4"></i>
                                Reportes por Coordinacion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('estantes')}}">
                                <i class="las la-plus fs-4"></i>
                                Mas
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="position-relative h-100 ">
                    <div class="position-absolute w-100" style="top: 90px;">
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle w-100" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name}}
                            </a>

                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">{{ __('Salir') }}
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 cuerpo-inicio">
                @yield('contenido')

                <div class="w-100 cuerpo-final px-md-4 pt-2">
                <p class="h-5">Sistema de Arhivo Municipal. &copy; 2022  Alcaldia de Capacho Nuevo</p>
</div>
            </main>
        </div>
    </div>
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    @yield('js')
</body>

</html>