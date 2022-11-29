@extends('plantilla.panel')
@section('css')
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
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a class="btn btn-outline-primary"><i class="las la-edit fs-4"></i></a>
                            <a class="btn btn-outline-primary"><i class="las la-trash-alt fs-4"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@endsection