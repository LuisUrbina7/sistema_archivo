@extends('plantilla.panel')

@section('css')

<title>Direccion</title>
@endsection

@section('contenido')
<section>
    @if ( session('correcto') )
    <div class="alert alert-success" role="alert">
        <strong>Felicitaciones </strong>
        {{session('correcto')}}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        <strong>Error </strong>
        {{session('error')}}
    </div>
    @endif
    <div class="container">
        <form action="{{route('direccion.crear')}}" method="post">
            <div class="row">
                @csrf
                <input type="hidden" name="idUsuario" value="{{ Auth::user()->id }}">
                <div class="col-12">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" placeholder="Nombre único" name="direccion" required>
                    @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="encargado">Responsable</label>
                    <input type="text" class="form-control" placeholder="Nombre y Apellido" name="encargado" required>
                    @error('encargado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-12 mt-3">
                    <input type="submit" value="Registrar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</section>

@endsection