@extends ('plantilla.panel')

@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Reportes</title>

@endsection

@section('contenido')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Archivo <span class="text-muted fs-6"></span></h1>

</div>
<section>


    <div class="row">
        <div class="col-md-3">
            <label for="direccion" class="form-label">Direccion</label>
            <select name="direccion" id="dato" class="form-select">
                <option disabled selected class="">--- Seleccione ---</option>
                @foreach($direcciones as $direccion)
                <option value="{{$direccion->id}}">{{$direccion->direccion}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" name="fecha_inicio" id="FechaInicio">
        </div>
        <div class="col-md-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" class="form-control" name="fecha_fin" id="FechaFin">
        </div>
        <div class="col-md-3 d-flex align-items-center justify-content-center">
            <div class="btn-group ">
                <a class="btn btn-primary" onclick="buscar()">Buscar</a>
                <a class="btn btn-danger" onclick="generarpdf()">PDF</a>
            </div>
        </div>
    </div>

    <div class="mt-3">

        <div class="d-flex justify-content-center">
            <div  role="status" id="cargando">
                <span class="visually-hidden">cargando...</span>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Folder</th>
                    <th>Instituto</th>
                    <th>Año</th>
                    <th>Responsable</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="tabla_consulta">
            </tbody>
        </table>

    </div>


</section>

@endsection

@section('js')
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script> -->
<script>
    /*   $(document).ready(function() {
        $('#example').DataTable();
    });
 */
    function generarpdf() {
        var Fecha1 = '';
        var Fecha2 = '';
        var dato = "";
        var url = "{{route('reporte.direccion.pdf',['dato','fecha1','fecha2'])}}";
        Fecha1 = $('#FechaInicio').val();
        Fecha2 = $('#FechaFin').val();
        dato = $('#dato').val();

        if (Fecha1 != '' && Fecha2 != '') {
            url = url.replace('dato', dato);
            url = url.replace('fecha1', Fecha1);
            url = url.replace('fecha2', Fecha2);
            window.open(url, '_blank');
        } else {
            window.open(url, '_blank');

        }


        console.log(url);
    }

    function buscar() {
        var Fecha1 = '';
        var Fecha2 = '';
        var dato = "";
        var url = "{{route('reporte.direccion.consulta',['dato','fecha1','fecha2'])}}";
        Fecha1 = $('#FechaInicio').val();
        Fecha2 = $('#FechaFin').val();
        dato = $('#dato').val();

        if (Fecha1 != '' && Fecha2 != '') {
            url = url.replace('dato', dato);
            url = url.replace('fecha1', Fecha1);
            url = url.replace('fecha2', Fecha2);
        }

        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            beforeSend: function(response) {
                $('#cargando').toggleClass('spinner-border');
            },
            success: function(response) {
                $('#cargando').toggleClass('spinner-border');
                $('#tabla_consulta').html('');
                /*          console.log(datos); */
                let contenido = '';
                $.each(response, function(index, item) {
                    contenido += '<tr><td> Nº' + item['folder'] + ' </td><td > ' + item['instituto'] + ' </td><td > ' + item['año'] + '</td><td > ' + item['responsable'] + '</td><td > ' + item['fecha'] + '</td></tr>';
                });
                $('#tabla_consulta').html(contenido);

            }
        });
    }

    /*    function pdf(url) {
           event.preventDefault();
           let datos = $('#formulario_consulta').submit();

       } */


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