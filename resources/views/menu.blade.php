@extends('plantilla.panel')
@section('css')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Menu</title>

@endsection


@section('contenido')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Usuarios</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#Modal-agregar">
                <i class="lab la-buromobelexperte fs-2"></i>
            </a>

        </div>
    </div>
</div>
<section class="container">
    <div class="row g-1 mb-3">
        <div class="col">
            <div class="contenedor-carta d-flex justify-content-center align-items-center">
                <div class="cuerpo-icono text-center w-25">
                    <i class="las la-users fs-1"></i>
                </div>
                <div class="cuerpo-texto text-center w-75">
                    <h1 class="h5">Usuarios</h1>
                    <span>{{$contador['usuarios']}}</span>
                    <p class="text-light">Registro de usuarios.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="contenedor-carta d-flex justify-content-center align-items-center">
                <div class="cuerpo-icono text-center w-25">
                    <i class="las la-database fs-1"></i>
                </div>
                <div class="cuerpo-texto text-center w-75">
                    <h1 class="h5">Direcciones</h1>
                    <span>{{$contador['direcciones']}}</span>
                    <p class="text-light">Registro de direcciones.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="contenedor-carta d-flex justify-content-center align-items-center">
                <div class="cuerpo-icono text-center w-25">
                    <i class="las la-columns fs-1"></i>
                </div>
                <div class="cuerpo-texto text-center w-75">
                    <h1 class="h5">Coordinaciones</h1>
                    <span>{{$contador['coordinaciones']}}</span>
                    <p class="text-light">Registro de Coordinaciones.</p>
                </div>
            </div>
        </div>

    </div>
    <div class="">
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
        <table class="table caption-top">
            <caption>Periodos | mandatos</caption>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Periodos </th>
                    <th scope="col">Dirigente</th>
                    <th scope="col">Partido</th>
                    <th scope="col">Op</th>
                </tr>
            </thead>
            <tbody>
                @php
                $contador=0;
                @endphp

                @foreach($periodos as $periodo)
                @php
                $contador+=1;
                @endphp
                <tr>
                    <th scope="row">{{$contador}}</th>
                    <td>{{$periodo->periodo}}</td>
                    <td>{{$periodo->regidor}}</td>
                    <td>{{$periodo->partido}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#Modal-{{$periodo->id}}"><i class="las la-edit fs-4"></i></a>
                            <a href="{{route('periodo.borrar',$periodo->id)}}" class="btn btn-outline-primary" onclick="borrar(this)"><i class="las la-trash-alt fs-4"></i></a>
                        </div>
                    </td>
                </tr>
              <!--   --modal para editar por post --- -->
                <div class="modal fade" id="Modal-{{$periodo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Periodos registrados</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('periodo.actualizar',$periodo->id)}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="periodo" class="form-label">Periodo :</label>
                                            <input type="text" name="periodo" class="form-control" value="{{$periodo->periodo}}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="regidor" class="form-label">Dirigente :</label>
                                            <input type="text" name="regidor" class="form-control" value="{{$periodo->regidor}}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="partido" class="form-label">Partido :</label>
                                            <input type="text" name="partido" class="form-control" value="{{$periodo->partido}}">
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-primary" value="Guardar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- ----menu periodos---- -->
<div class="modal fade" id="Modal-agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Periodos registrados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('periodo.agregar')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="periodo" class="form-label">Periodo :</label>
                            <input type="text" name="periodo" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="regidor" class="form-label">Dirigente :</label>
                            <input type="text" name="regidor" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="partido" class="form-label">Partido :</label>
                            <input type="text" name="partido" class="form-control">
                        </div>
                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-primary" value="Guardar">
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
</script>
@endsection