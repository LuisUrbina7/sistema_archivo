<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inicio') }}</title>
    <!-- Styles -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">


</head>

<body>
   

        <main class="py-4 form-signin text-center">
           
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <img class="mb-4" src="" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Inicio</h1>
    
                    <div class="form-floating">
                        <input id="username" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="v00000000" value="{{ old('username') }}" autofocus>
                        <label for="floatingInput">Usuario</label>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>Error, contraseña o usuario incorrecto.</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="contraseña" name="password" value="{{ old('password') }}">
                        <label for="floatingPassword" >Contraseña</label>
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
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
                </form>
            

        </main>
        <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>