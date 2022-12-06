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
    <h1 class="h2">Archivo <span class="text-muted fs-6"></span></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{route('archivo.formulario.crear')}}" class="btn btn-sm btn-outline-secondary">
                +
            </a>
            <a class="btn btn-sm btn-outline-secondary">Agregar</a>
        </div>
    </div>
</div>
<section class="cuerpo-carta">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Direccion</th>
                <th>Año</th>
                <th>Folder</th>
                <th>Responsable</th>
                <th>Estante</th>
                <th>Periodo</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($archivos as $archivo)

            <tr>
                <td>{{$archivo->Direccion->direccion}}</td>
                <td>{{$archivo->año}}</td>
                <td>N°{{$archivo->folder}}</td>
                <td>{{$archivo->responsable}}</td>
                <td> <span class="badge bg-success"> # {{$archivo->Estante->numero}}</span> </td>
                <td> <span class="badge bg-warning">  {{$archivo->Periodo->periodo}}</span> </td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('archivo.ver',$archivo->id)}}" class="btn btn-primary active" aria-current="page"><i class="lar la-eye fs-5"></i></a>
                        <a href="{{route('reporte.etiqueta.pdf',$archivo->id)}}" target="_blank" class="btn btn-secundary"><i class="las la-pen fs-5"></i></a>
                        <a href="{{route('archivo.borrar',$archivo->id)}}" class="btn btn-danger" onclick="borrar(this)"><i class="las la-window-close fs-5"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach

            </tfoot>
    </table>



</section>

@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No hay datos - Disculpa",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtrado por _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"

                },
            }
        });
    });

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