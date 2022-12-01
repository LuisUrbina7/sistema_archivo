@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Direccion</title>

@endsection

@section('contenido')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Estantes</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#Modal-agregar">
                +
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Agregar</button>
        </div>
    </div>
</div>
<section>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Estantes</th>
                    <th scope="col">Foldes</th>
                    <th scope="col">Op</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        </div>
    </div>
   
</section>


@endsection

@section('js')

@endsection