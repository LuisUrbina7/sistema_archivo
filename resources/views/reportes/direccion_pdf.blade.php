<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>{{$fechas['inicio']}} *** {{$fechas['fin']}}</title>
    <style>
        .barra-descripcion {
            display: flex;
            justify-content: space-between;

        }
    </style>
</head>

<body>

    <div class="text-center">
        <h2>
            Reporte de Archivo por Direccion.
        </h2>
        <hr>
        @php
        $registros = count($archivos);
        @endphp

        <div class="text-start">
        <h5 class="h6 text-muted">Desde {{$fechas['inicio']}} hasta {{$fechas['fin']}}.</h5>
        <p> <strong>Registros encontrados : {{$registros}}</strong> </p>
        </div>
    
    </div>
    <table class="table">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Direccion</th>
                <th scope="col">Coordinacion</th>
                <th scope="col">Folder</th>
                <th scope="col">Año</th>
                <th scope="col">Responsable</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        <tbody>

            @php
            $contador=0;
            @endphp
            @foreach($archivos as $archivo)
            @php
            $contador+=1;
            @endphp
            <tr>
                <th scope="row">{{$contador}}</th>
                <th scope="row">{{$archivo->Direccion->direccion}}</th>
                <td>{{$archivo->Coordinacion->coordinacion}}</td>
                <td>Nº {{$archivo->folder}}</td>
                <td>{{$archivo->año}}</td>
                <td>{{$archivo->responsable}}</td>
                <td>{{$archivo->fecha}}</td>

            </tr>
            @endforeach
            <tfoot>

            </tfoot>
        </tbody>
    </table>

    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>