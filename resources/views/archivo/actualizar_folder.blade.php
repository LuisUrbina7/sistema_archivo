@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Archivo</title>

@endsection

@section('contenido')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Archivo </h1>
   
</div>
<section>
@if ( session('excelente') )
<div class="alert alert-success" role="alert">
    <strong>Felicitaciones </strong>
    {{session('excelente')}}
</div>
@endif
@if ( session('error') )
<div class="alert alert-danger" role="alert">
    <strong>Error </strong>
    {{session('error')}}
</div>
@endif
    <form method="POST" action="{{route('archivo.folder.actualizar',$folder->id)}}">

    <div class="row g-3">

        @csrf
            <div class="col-md-6">
                <label for="direccion" class="form-label">Direccion <span class="text-danger">*</span></label>
                <select id="inputState" class="form-select @error('direccion') is-invalid @enderror" name="direccion">
                    <option value="{{$folder->direccion}}" selected>{{$folder->Direccion->direccion}}
                    @foreach($direcciones as $direccion)
                    <option value="{{$direccion->id}}">{{$direccion->direccion}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="coordinacion " class="form-label">Coordinacion</label>
                <select id="inputState" class="form-select" name="coordinacion">
                    <option disabled selected>--seleccione---</option>
                    @foreach($coordinaciones as $coordinacion)
                    <option value="{{$coordinacion->id}}">{{$coordinacion->coordinacion}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Instituto</label>
                <input type="text" class="form-control " id="inputAddress" name="instituto" placeholder="Nombre del Instituto" value="{{$folder->instituto}}"> 
            </div>
            <div class="col-md-6">
                <label for="año" class="form-label @error('año') is-invalid @enderror">Año<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="año" value="{{$folder->año}}">
                @error('año')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="folder" class="form-label @error('folder') is-invalid @enderror">Folder<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="folder" name="folder" value="{{$folder->folder}}">
                @error('folder')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-12">
                <label for="responsable" class="form-label @error('responsable') is-invalid @enderror">Responsable<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="responsable" name="responsable" placeholder="Nombre del encargado." value="{{$folder->responsable}}">
                @error('responsable')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-7">
                <label for="recibido" class="form-label">Recibido</label>
                <input type="text" class="form-control" name="recibido" readonly value="{{$folder->Usuario->name}}">
            </div>
            <div class="col-md-5">
                <label for="fecha" class="form-label @error('fecha') is-invalid @enderror">Fecha<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="fecha" value="{{$folder->fecha}}">
                @error('fecha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-8">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea name="observaciones" id="observaciones" cols="4" rows="2" class="form-control" >{{$folder->observaciones}}</textarea>
            </div>
            <div class="col-md-4">
                <label for="fecha" class="form-label">Color</label>
                <input type="color" class="form-control  form-control-color" name="color" value="{{$folder->color}}">
            </div>
            <div class="col-12 mb-3">
                <input type="submit" class="btn btn-warning"  value="Actualizar">
            </div>
    </div>
    </form>
</section>

@endsection

@section('js')
<script>
   
</script>
@endsection