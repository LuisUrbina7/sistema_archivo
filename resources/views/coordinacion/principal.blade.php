@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Coordinacion</title>

@endsection

@section('contenido')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Coordinaciones</h1>
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
    <!--  @if ( session('correcto') )
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
    @endif -->
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Coordinacion</th>
                    <th scope="col">Encargado</th>
                    <th scope="col">Creador</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
               

                @foreach($coordinaciones as $coordinacion)
             
                <tr>
                    <th scope="row">{{$coordinacion->id}}</th>
                    <td>{{$coordinacion->coordinacion}}</td>
                    <td>{{$coordinacion->encargado}}</td>
                    <td><span class="badge bg-secondary">{{$coordinacion->Usuario->name}}</span> </td>
                    <td><a href="{{route('coordinacion.crear')}}" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modal-actualizar" onclick="indice('{{$coordinacion->id}},{{$coordinacion->coordinacion}},{{$coordinacion->encargado}}')"><i class="las la-edit"></i></a></td>
                    <td><a href="{{route('coordinacion.borrar',$coordinacion->id)}}" class="btn btn-danger" onclick="borrar(this)"><i class="las la-broom"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$coordinaciones->links()}}
    </div>
</section>

<!-- ----modal agregar---- -->
<div class="modal fade" id="Modal-agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="formulario_crear">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="idUsuario" value="{{ Auth::user()->id }}">
                        <div class="col-12">
                            <label for="coordinacion">Coordinacion</label>
                            <input type="text" class="form-control" placeholder="Nombre único" name="coordinacion" required>
                        </div>
                        <div class="col-12">
                            <label for="encargado">Responsable</label>
                            <input type="text" class="form-control" placeholder="Nombre y Apellido" name="encargado" required>

                        </div>
                        <div class="col-12 mt-3 modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
                            <input type="submit" value="Registrar" class="btn btn-primary" id="btn-agregar">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- ----modal actualizar---- -->
<div class="modal fade" id="Modal-actualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="formulario_actualizar">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="idUsuario" value="{{ Auth::user()->id }}">
                        <div class="col-12">
                            <label for="coordinacion">coordinacion</label>
                            <input type="text" class="form-control" id="coordinacion" placeholder="Nombre único" name="coordinacion" required>

                        </div>
                        <div class="col-12">
                            <label for="encargado">Responsable</label>
                            <input type="text" class="form-control" id="responsable" placeholder="Nombre y Apellido" name="encargado" required>

                        </div>
                        <div class="col-12 mt-3 modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
                            <input type="submit" value="Actualizar" class="btn btn-primary" id="btn-actualizar">
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
    $('#btn-agregar').click(function(e) {
        e.preventDefault();

        let datos = $('#formulario_crear').serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       
        $.ajax({
            type: 'POST',
            url: "{{route('coordinacion.crear')}}",
            data: datos,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.msg == 'excelente') {
                    $('#Modal-agregar').hide();
                    Swal.fire(
                        'Excelente',
                        'Actualizado Correctamente',
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
    });


    $('#btn-actualizar').click(function(e) {
        e.preventDefault();

        let datos = $('#formulario_actualizar').serialize();
        let url = $('#formulario_actualizar').attr('action');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: url,
            data: datos,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                console.log(response.msg);
                if (response.msg == 'excelente') {
                    $('#Modal-agregar').hide();
                    Swal.fire(
                        'Excelente',
                        'Actualizado Correctamente',
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
    });

    function indice(ref) {
        var vector = ref.split(',');
        let indice = "{{route('coordinacion.actualizar',0)}}";
        let nuevo_indice = indice.replace('0', vector[0]);

        $('#coordinacion').val(vector[1]);
        $('#responsable').val(vector[2]);

        $('#formulario_actualizar').attr('action', nuevo_indice);

    }

    function borrar(ref) {
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
                    url: ref,
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