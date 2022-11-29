@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Archivo</title>

@endsection

@section('contenido')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Archivo <span class="text-muted fs-6"> /paso 1</span></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="me-2">
            <p>Registro n# : <strong> {{$indice['id']}}</strong></p>
            <p>Folder n# : <strong> {{$indice['folder']}}</strong></p>
        </div>
    </div>
</div>
<section>
    @if ( session('excelente') )
    <div class="alert alert-success" role="alert">
        <strong>Felicitaciones </strong>
        {{session('excelente')}}
    </div>
    @endif
    @if ( session('error') )
    <div class="alert alert-success" role="alert">
        <strong>Error </strong>
        {{session('error')}}
    </div>
    @endif
    <form method="POST" action="{{route('archivo.crear')}}" id="formulario_archivo_agregar">
        @csrf
        <input type="hidden" value="{{$indice['id']}}" name="referencia">
        <div class="row g-3 formulario-visible" id="formulario_uno">

            <div class="col-md-6">
                <label for="direccion" class="form-label">Direccion <span class="text-danger">*</span></label>
                <select id="inputState" class="form-select @error('direccion') is-invalid @enderror" name="direccion">
                    <option disabled selected>---seleccione---</option>
                    @foreach($direcciones as $direccion)
                    <option value="{{$direccion->id}}">{{$direccion->direccion}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="coordinacion " class="form-label">Coordinacion<span class="text-danger">*</span></label>
                <select id="inputState" class="form-select @error('coordinacion') is-invalid @enderror"  name="coordinacion">
                    <option disabled selected>---seleccione---</option>
                    @foreach($coordinaciones as $coordinacion)
                    <option value="{{$coordinacion->id}}">{{$coordinacion->coordinacion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Instituto</label>
                <input type="text" class="form-control " id="inputAddress" name="instituto" placeholder="Nombre del Instituto">
            </div>
            <div class="col-md-6">
                <label for="año" class="form-label @error('año') is-invalid @enderror">Año<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="año">
                @error('año')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="folder" class="form-label @error('folder') is-invalid @enderror">Folder<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="folder" name="folder" value="{{$indice['folder']}}">
                @error('folder')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-12">
                <label for="responsable" class="form-label @error('responsable') is-invalid @enderror">Responsable<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="responsable" name="responsable" placeholder="Nombre del encargado.">
                @error('responsable')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-7">
                <label for="recibido" class="form-label">Recibido</label>
                <input type="text" class="form-control" name="recibido" readonly value="{{ Auth::user()->name}}">
            </div>
            <div class="col-md-5">
                <label for="fecha" class="form-label @error('fecha') is-invalid @enderror">Fecha<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="fecha">
                @error('fecha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-8">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea name="observaciones" id="observaciones" cols="4" rows="2" class="form-control"></textarea>
            </div>
            <div class="col-md-4">
                <label for="fecha" class="form-label">Color</label>
                <input type="color" class="form-control  form-control-color" name="color">
            </div>
            <div class="col-12">
                <input class="btn btn-primary" onclick="pasos(event)" value="Siguiente">
            </div>
        </div>


        <div class="row g-2 formulario-oculto" id="formulario_dos">
            <div class="col-md-3">
                <label for="documento" class="form-label">Documento</label>
                <input type="text" class="form-control" id="documento">
            </div>
            <div class="col-md-3">
                <label for="solicitud" class="form-label">Solicitud</label>
                <input type="text" class="form-control" id="solicitud">
            </div>
            <div class="col-md-3">
                <label for="folios" class="form-label">Folios</label>
                <input type="number" class="form-control" id="folios" onkeyup="insertar_fila(event)">
            </div>
            <div class="col-md-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="completo" id="check_1" onclick="check_uno()">
                    <label class="form-check-label" for="flexCheckDefault">
                        completo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="faltante" id="check_2" checked onclick="check_dos()">
                    <label class="form-check-label" for="flexCheckChecked">
                        faltante
                    </label>
                </div>
            </div>
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Solicitud</th>
                            <th scope="col">Folios</th>
                            <th scope="col">AP</th>
                            <th scope="col">Borrar</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_cuerpo">

                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <input class="btn btn-primary" onclick="pasos(event)" value="Atrás">
                <input class="btn btn-primary" value="Guardar" id="btn-guardar" onclick="guardar(event)">
            </div>
        </div>
    </form>
</section>

@endsection

@section('js')
<script>
    function guardar(event) {
        $('#formulario_archivo_agregar').submit();
    }

    function pasos(event) {
        event.preventDefault();
        $('#formulario_uno').toggleClass('formulario-visible');
        $('#formulario_uno').toggleClass('formulario-oculto');
        $('#formulario_dos').toggleClass('formulario-oculto');
    }



    function insertar_fila(event) {
        /*  console.log(event); */

        var keycode = event.keyCode;
        let documento = $('#documento').val();
        let solicitud = $('#solicitud').val();
        let folios = $('#folios').val();

        if (keycode == 13 && documento != '' && solicitud != '' && folios != '' && ($('#check_2').is(':checked') || $('#check_1').is(':checked'))) {
            let check = '<input class="form-check-input" type="checkbox" value="revisado"  name="ap[]" id="flexCheckDefault" checked> <label class="form-check-label" for="flexCheckChecked">No completo </label>';
            if ($('#check_1').is(':checked')) {
                check = '<input class="form-check-input" type="checkbox" value="faltante"  name="ap[]" id="flexCheckDefault" checked > <label class="form-check-label" for="flexCheckChecked"> completo </label>';
            }

            var contenido_tabla = $('#tabla_cuerpo').html();
            contenido_tabla += '<tr>' +
                '<td> ' + 1 + '</td>' +
                '<td><input class="form-control" type="text"  name="documento[]" value="' + documento + '"></td>' +
                '<td><input class="form-control" type="text"  name="solicitud[]" value="' + solicitud + '"></td>' +
                '<td><input class="form-control" type="text"  name="folios[]" value="' + folios + '"></td>' +
                '<td>' + check + '</td>' +
                '<td><a class="btn btn-danger" onclick="borrar(this)"></td></tr>';
            $('#tabla_cuerpo').html(contenido_tabla);
            limpiar();
        }




    }

    function limpiar() {
        $('#documento').val('');
        $('#solicitud').val('');
        $('#folios').val('');
        $('#documento').focus()
    }

    function check_uno() {
        $('#check_2').prop('checked', false);
    }

    function check_dos() {
        $('#check_1').prop('checked', false);
    }

    function borrar(ref) {
        $(ref).closest('tr').remove();
    }
</script>
@endsection