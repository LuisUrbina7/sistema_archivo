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
</div>
<section class="cuerpo-carta">
      @if ( session('excelente') )
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
    <div class="row">
        <div class="col-md-4">

        <form action="{{route('estante.agregar')}}" method="post" class="border p-3" id="estantes-formulario">
            @csrf
            <div class="mb-3">
                <label for="codigo" class="label-control">Código:</label>
                <input type="text" class="form-control" name="codigo">
            </div>
            <div class="mb-3">
                <label for="numero" class="label-control">Número:</label>
                <input type="number" class="form-control" name="numero">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="label-control">Descripción:</label>
                <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control"></textarea>
            </div>
            <div class="mb-3">
               <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </form>

        </div>
        <div class="col-md-8">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Estantes</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Foldes</th>
                    <th scope="col">Op</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estantes as $estante)
                <tr>
                    <td class="codigo">{{$estante->codigo}}</td>
                    <td class="numero"> {{$estante->numero}}</td>
                    <td class="descripcion">{{$estante->descripcion}}</td>
                    <td >Hay <span class="badge bg-warning fs-6">{{$estante->archivos_count}}</span>  archivos.</td>
                    <td><a href="{{route('estante.actualizar',$estante->id)}}" class="btn btn-warning mx-1" id="btn-editar"><i class="las la-edit"></i></a><a href="{{route('estante.borrar',$estante->id)}}" class="btn btn-danger" onclick="borrar(this)"><i class="las la-broom"></i></a></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
       {{$estantes->links()}}
        </div>
    </div>
   
</section>


@endsection

@section('js')
<script>

    $(document).on('click','#btn-editar',function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        let codigo = $(this).closest('tr').find('.codigo').text();
        let numero = $(this).closest('tr').find('.numero').text();
        let descripcion = $(this).closest('tr').find('.descripcion').text();
      
       $("input[name='codigo']").val(codigo);
       $("input[name='numero']").val(parseInt(numero));
       $('#descripcion').val(descripcion);

       $('#estantes-formulario').attr('action',url);
    });
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