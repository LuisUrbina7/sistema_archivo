@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Direccion</title>

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
            <a class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#Modal-agregar">
                <i class="las la-user-plus fs-2"></i>
            </a>
            <a  class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#Modal-listar">
                <i class="las la-list-ul fs-2"></i>
            </a>
        </div>
    </div>
</div>
<section>

    <form class="row g-3" method="POST" action="{{ route('perfil.actualizar', Auth::user()->id) }}">
        @csrf
        <div class="col-md-6">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ Auth::user()->name }}">

            @error('nombre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="col-md-6">
            <label for="name" class="form-label">{{ __('Usuario') }}</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ Auth::user()->username }}">

            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="col-12">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <div class="col-md-12">
            <label for="rol" class="form-label">{{ __('Permisos') }}</label>

            <select id="rol" class="form-select" name="rol">
                <option value="{{ Auth::user()->rol }}">--Permiso--</option>
                <option value="0">Administrador</option>
                <option value="1">Editor</option>
            </select>

            @error('rol')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="col-md-12">
            <label for="rol" class="form-label">{{ __('Clave Vieja') }}</label>
            <input id="clave_vieja" type="password" class="form-control @error('clave_vieja') is-invalid @enderror" name="clave_vieja">

            @error('clave_vieja')
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

<!-- -----modal agregar----- -->
<div class="modal fade" id="Modal-agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">Usuarios registrados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="contenedor_alerta">

                </div>
                <form method="POST" action="{{ route('usuarios.crear')}}" id="formulario_crear">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Usuario') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="rol" class="col-md-4 col-form-label text-md-end">{{ __('Permisos') }}</label>

                        <div class="col-md-6">
                            <select id="rol" class="form-select" name="rol">
                                <option selected>---seleccione---.</option>
                                <option value="0">Administrador</option>
                                <option value="1">Editor</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmaciòn') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" id="btn-agregar">
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- -----modal listar usuarios----- -->
<div class="modal fade" id="Modal-listar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">Usuarios registrados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Borrar</th>
                        </tr>
                    </thead>
                    <tbody id="lista-usuarios">


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- -----modal roles----- -->

@endsection

@section('js')


<script>
    $(document).ready(function() {

        let datos = $('#formulario_crear').serialize();

        $.ajax({
            type: 'GET',
            url: "{{route('usuarios')}}",
            dataType: 'json',
            success: function(response) {
                console.log(response);
                let contenido = '';
                $.each(response, function(index, item) {
                    contenido += '<tr>\
                            <th scope="row">' + index + '</th>\
                            <td>' + item['name'] + '</td>\
                            <td>' + item['username'] + '</td>\
                            <td>' + item['email'] + '</td>\
                            <td>' + item['rol'] + '</td>\
                            <td><a href="./usuarios/vista/' + item['id'] + '" class="btn btn-primary"><i class="las la-edit"></i></a></td>\
                            <td><a href="./usuarios/borrar/' + item['id'] + '" class="btn btn-danger" onclick="borrar(this)"> <i class="las la-broom"></i></a></td>\
                        </tr>';
                });

                $('#lista-usuarios').html(contenido);

            }
        });


        $('#btn-agregar').click(function(e) {
            e.preventDefault();

            let datos = $('#formulario_crear').serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{route('usuarios.crear')}}",
                data: datos,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    let alerta = '';
                    if (response == 'excelente') {
                        alerta += '  <div class="alert alert-success" role="alert">\
                        <strong>Felicitaciones </strong>\
                        usuario agregado correctamente.. </div>';  
                    $('#contenedor_alerta').html(alerta);
                    location.reload();
                    } else {
                        alerta += '  <div class="alert alert-danger" role="alert">\
                        <strong>Error </strong>\
                        ocurrio algo.. </div>';
                       
                        $('#contenedor_alerta').html(alerta);
                    }

                }
            });
        });


    });


    function borrar(ref) {
        event.preventDefault();
        Swal.fire({
            title: '¿Segur@?',
            text: "Se borrará todo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'GET',
                    url: ref,
                    success: function(response) {
                        console.log(response.msg);
                        if (response.msg == 'excelente') {
                            Swal.fire(
                                'Excelente',
                                'Borrado Correctamente',
                                'success'
                            )
                            location.reload();
                        } else {
                            Swal.fire(
                                'Error',
                                'Algo ocurrió, inténtalo más tarde.',
                                'error'
                            );
                        }
                    }
                });
            }
        })
    }
</script>
@endsection