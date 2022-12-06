@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Archivo</title>

@endsection

@section('contenido')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Folder N#<strong>{{$folder->folder}}</strong></h1>
</div>
<section class="cuerpo-carta">
<div class="row">
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item"><strong>Direccionnnn : </strong> {{$folder->Direccion->direccion}}</li>
            <li class="list-group-item"><strong>Coordinacion : </strong> {{$folder->coordinacion}}</li>
            <li class="list-group-item"><strong>Instituto : </strong> {{$folder->instituto}}</li>
            <li class="list-group-item"><strong> Año : </strong> {{$folder->año}}</li>
            <li class="list-group-item"><strong>Folder N#: </strong> {{$folder->folder}}</li>
            <li class="list-group-item"><strong>Estante N#: </strong> {{$folder->estante}}</li>

        </ul>
    </div>
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item"><strong>Responsable : </strong> {{$folder->responsable}}</li>
            <li class="list-group-item"><strong> Recibido : </strong> {{$folder->Usuario->name}}</li>
            <li class="list-group-item"><strong> Fecha : </strong> {{$folder->fecha}}</li>
            <li class="list-group-item"><strong>Color : </strong> {{$folder->color}}</li>
            <li class="list-group-item"><strong>Observaciones :</strong> {{$folder->observaciones}}</li>
        </ul>
    </div>
    <div class="col-12">
        <h4>Detalles del Archivo..</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Folios</th>
                    <th scope="col">Solicitud</th>
                    <th scope="col">AP</th>
                </tr>
            </thead>
            <tbody>

                @php
                $contador=0;
                @endphp
                @foreach($folder_detalles as $detalles)
                @php
                $contador+=1;
                @endphp
                <tr>
                    <td>{{$contador}}</td>
                    <td>{{$detalles->documento}}</td>
                    <td>{{$detalles->folios}}</td>
                    <td>{{$detalles->solicitud}}</td>
                    <td>{{$detalles->ap}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



</section>

@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection