@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Archivo</title>

@endsection

@section('contenido')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Folder N#<strong>{{$folder->folder}}</strong></h1>
    <div class="dropdown">
        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-braille fs-3"></i>
        </button>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{route('archivo.formulario.folder.actualizar',$folder->id)}}">Editar Folder</a></li>
            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Modal-agregar-detalles">Agreagr Detalles</a></li>
        </ul>
    </div>
</div>
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
<section class="cuerpo-carta">
<div class="row">
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item"><strong>Direccion : </strong> {{$folder->Direccion->direccion}}</li>
            <li class="list-group-item"><strong>Coordinacion : </strong> {{$folder->Coordinacion->coordinacion}}</li>
            <li class="list-group-item"><strong>Instituto : </strong> {{$folder->instituto}}</li>
            <li class="list-group-item"><strong> Año : </strong> {{$folder->año}}</li>
            <li class="list-group-item"><strong>Folder N#: </strong> {{$folder->folder}}</li>
            <li class="list-group-item"><strong>Estante : </strong>Número {{$folder->estante}}</li>

        </ul>
    </div>
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item"><strong>Responsable : </strong> {{$folder->responsable}}</li>
            <li class="list-group-item"><strong> Recibido : </strong> {{$folder->Usuario->name}}</li>
            <li class="list-group-item"><strong> Fecha : </strong> {{$folder->fecha}}</li>
            <li class="list-group-item"><strong>Color : </strong> {{$folder->color}}</li>
            <li class="list-group-item"><strong>Observaciones :</strong> {{$folder->observaciones}}</li>
            <li class="list-group-item"><strong>Periodo :</strong> {{$folder->Periodo->periodo}}</li>
        </ul>
    </div>
    <div class="col-12 mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
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

                <form action="{{route('archivo.detalles.actualizar',$detalle->id)}}" method="post">
                    @csrf
                    <tr>
                        <td>{{$contador}}</td>
                        <td><input class="form-control" type="text" name="documento" value="{{$detalle->documento}}"></td>
                        <td><input class="form-control" type="text" name="solicitud" value="{{$detalle->solicitud}}"></td>
                        <td><input class="form-control" type="number" name="folios" value="{{$detalle->folios}}"></td>
                        <td><select class="form-select" name="ap">
                                <option selected value="{{$detalle->ap}}">{{$detalle->ap}}</option>
                                <option value="revisado">Revisado</option>
                                <option value="faltante">Faltante</option>
                            </select></td>
                        <td>
                            <div class="btn-group">
                                <button type="submit" href="#" class="btn btn-outline-primary"><i class="las la-sync-alt fs-4"></i></button>
                                <a href="{{route('archivo.detalles.borrar',$detalle->id)}}" class="btn btn-outline-primary" onclick="borrar(this)"><i class="las la-times fs-4"></i></a>
                            </div>
                        </td>
                    </tr>
                </form>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


</section>
<!-- ----- modal agregar detalles --- -->
<div class="modal fade" id="Modal-agregar-detalles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('archivo.detalles.agregar')}}" method="post">

                    <div class="row g-3">
                        @csrf
                        <input type="hidden" value="{{$folder->id}}" name="referencia">
                        <div class="col-md-3">
                            <label for="documento" class="form-label">Documento</label>
                            <input type="text" class="form-control" name="documento" required>
                        </div>
                        <div class="col-md-3">
                            <label for="solicitud" class="form-label">Solicitud</label>
                            <input type="text" class="form-control" name="solicitud" required>
                        </div>
                        <div class="col-md-3">
                            <label for="folios" class="form-label">Folios</label>
                            <input type="number" class="form-control" name="folios" onkeyup="insertar_fila(event)">
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="revisado"  id="check_1" onclick="check_uno()" name="ap" >
                                <label class="form-check-label" for="flexCheckDefault">
                                    Completo
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="faltante" id="check_2" checked onclick="check_dos()" name="ap">
                                <label class="form-check-label" for="flexCheckChecked">
                                    No completo
                                </label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <input type="submit" class="btn btn-primary w-25" value="Agregar">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
 
    function borrar(url) {
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
                    url: url,
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
    function check_uno(){
        $('#check_2').prop('checked', false);     
    }
    function check_dos(){
        $('#check_1').prop('checked', false);     
    }
</script>
@endsection