<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Etiqueta</title>
   
</head>

<body>
<div class="">
    <div class="text-center mb-4"> <h5>ALCALDIA MUNICIPIO CAPACHO NUEVO <br> ARCHIVO MINICIPAL <br> 15/03/2022</h5></div>
    <div class="px-4 mb-4">
        <ul class="list-group">
            <li class="list-group-item"><strong>Direccion : </strong> {{$folder->Direccion->direccion}}</li>
            <li class="list-group-item"><strong>Coordinacion : </strong> {{$folder->Coordinacion->coordinacion}}</li>
            <li class="list-group-item"><strong>Instituto : </strong> {{$folder->instituto}}</li>
            <li class="list-group-item"><strong> Año : </strong> {{$folder->año}}</li>
            <li class="list-group-item"><strong>Folder N#: </strong> {{$folder->folder}}</li>
            <li class="list-group-item"><strong>Responsable : </strong> {{$folder->responsable}}</li>

        </ul>
    </div>
   
    <div class="col-12 px-1 mb-4">
        <table class="table table-bordered">
            <thead class="bg-secondary text-white">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Solicitud</th>
                    <th scope="col">Folios</th>
                    <th scope="col">AP</th>
                </tr>
            </thead>
            <tbody id="tabla_cuerpo">

                @php
                $contador=0;
                @endphp

                @foreach($folder_detalles as $detalle)
                @php
                $contador+=1;
                @endphp
                    <tr>
                        <td>{{$contador}}</td>
                        <td>{{$detalle->documento}}</td>
                        <td>{{$detalle->solicitud}}</td>
                        <td>{{$detalle->folios}}</td>
                        <td>{{$detalle->ap}}</option>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 mb-4">
        <ul class="list-group">
            <li class="list-group-item"><strong>Recibido : </strong> {{$folder->Usuario->name}}</li>
            <li class="list-group-item"><strong>Fecha : </strong> {{$folder->fecha}} </li>
           

        </ul>
    </div>
    <div class="text-center mb-4"> <p>EN CAPACHO NUEVO  RENACE LA ESPERANZA<br> 2022</p></div>
</div>

    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>