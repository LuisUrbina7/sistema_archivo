<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inicio</title>
    <!-- Styles -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/inicio-sesion.css')}}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <main class="container-fluid fondo">
        <div class="d-flex contenedor-sesion shadow bg-light">
            <div class="text-center w-50 py-3">
                <form method="POST" action="{{ route('login') }}" class="form-signin">
                    @csrf
                    <span><i class="las la-user fs-1 icono-user shadow-sm"></i></span>
                    <h1 class="h3 mb-3 fw-normal">Inicio de Sesión</h1>

                    <div class="form-floating">
                        <input id="username" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="v00000000" value="{{ old('username') }}" autofocus required>
                        <label for="floatingInput">Usuario</label>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>Error, contraseña o usuario incorrecto.</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="contraseña" name="password" value="{{ old('password') }}" required>
                        <label for="floatingPassword">Contraseña</label>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="checkbox mb-3">
                        <label>
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
                        </label>
                    </div>
                    <button class="w-100 btn-sesion" type="submit">Iniciar</button>
                    <p class="mt-1 mb-2 text-muted">&copy; 2021–2022</p>
                </form>
            </div>
            <div class="w-50">
              <div class="sesion-img">
              
              </div>
            </div>
        </div>
    </main>
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>