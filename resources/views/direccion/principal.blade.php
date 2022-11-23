@extends('plantilla.panel')

@section('css')

<title>Direccion</title>
@endsection

@section('contenido')
<section>
    @if ( session('correcto') )
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
    @endif
    <div class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal-agregar">
            Launch demo modal
        </button>
        <a href="{{route('direccion.formulario.crear')}}" class="btn btn-primary"></a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Encargado</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($direcciones as $direccion)
                <tr>
                    <th scope="row"></th>
                    <td>{{$direccion->direccion}}</td>
                    <td>{{$direccion->encargado}}</td>
                    <td><a href="" class="btn btn-warning">Editar</a></td>
                    <td><a href="" class="btn btn-danger">Borrar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- ----modal agregar---- -->
<div class="modal fade" id="Modal-agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Datos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
$('#btn-actualizar').click(function(e) {
        e.preventDefault();
        let rutaActualizar = '{{route("categoria.actualizar.insertar","id")}}';
        let datos = {
            nombre: $('#nombre').val()
        };
        let id = $('#id').val();
        rutaActualizar = rutaActualizar.replace('id', id);
        /*  console.log(id);
         console.log(rutaActualizar); */

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: rutaActualizar,
            data: datos,
            dataType: 'json',
            success: function(response) {
                console.log(response.msg);
                if (response.msg == 'excelente') {
                    Swal.fire(
                        'Excelente',
                        'Actualizado Correctamente',
                        'success'
                    )
                    location.reload();
                } else {

                }
            }
        });
    });
@endsection