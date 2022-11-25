@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Actualizar Usuario</title>
@endsection

@section('contenido')
@if ( session('nombre') )
<div class="alert alert-success" role="alert">
    <strong>Felicitaciones </strong>
    Nombre y rol modificados..
</div>
@endif
@if ( session('claveIncorrecta') )
<div class="alert alert-danger" role="alert">
    <strong>Lo siento!</strong> {{ session('claveIncorrecta') }}
</div>
@endif

@if ( session('Clave') )
<div class="alert alert-success" role="alert">
    <strong>Felicitaciones !</strong>
    {{ session('Clave') }}
</div>
@endif
@if ( session('error') )
<div class="alert alert-danger" role="alert">
    <strong>Error !</strong>
    {{ session('error') }}
</div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Usuarios</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{route('perfil')}}" class="btn btn-sm btn-outline-secondary">
            <i class="las la-arrow-left fs-2"></i>
            </a>
        </div>
    </div>
</div>
<section>

    <form class="row g-3" method="POST" action="{{ route('usuarios.actualizar', $usuario->id) }}">
        @csrf
        <div class="col-md-6">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $usuario->name }}">

            @error('nombre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="col-md-6">
            <label for="name" class="form-label">{{ __('Usuario') }}</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $usuario->username }}">

            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="col-12">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <div class="col-md-12">
            <label for="rol" class="form-label">{{ __('Permisos') }}</label>

            <select id="rol" class="form-select" name="rol">
                <option value="{{ $usuario->rol }}">{{ $usuario->rol }}</option>
                <option value="0">Administrador</option>
                <option value="1">Editor</option>
            </select>

            @error('rol')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        
        <div class="col-md-6">
            <label for="password" class="form-label">{{ __('Nueva') }}</label>
            <input id="clave" type="password" class="form-control @error('clave') is-invalid @enderror" name="clave">
            @error('clave')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="password-confirm" class="form-label">{{ __('Confirmar') }}</label>

            <input id="confirmacion_clave" type="password" class="form-control" name="confirmacion_clave">

        </div>
        <div class="col-12">
            <input type="submit" class="btn btn-primary" value="Actualizar">
        </div>
    </form>
</section>

<!-- -----modal listar usuarios----- -->

@endsection

@section('js')


@endsection