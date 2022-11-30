<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Archivos_detalles;
use App\Models\Coordinacion;
use App\Models\Direccion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index_direcciones()
    {
        $direcciones = Direccion::select('id', 'direccion')->get();
        return view('reportes.direccion', compact('direcciones'));
    }
    public function direcciones_consulta($dato, $fecha_1, $fecha_2)
    {
        $consulta = Archivo::where('direccion', $dato)->get();
        if ($fecha_1 != 'fecha1' && $fecha_2 != 'fecha2') {
            $consulta = Archivo::where('direccion', $dato)->whereBetween('fecha', [$fecha_1, $fecha_2])->get();
        }
        return response()->json($consulta);
    }
    public function direcciones_pdf($dato, $fecha_1, $fecha_2)
    {
        $fechas = ['inicio' => 'Todo', 'fin' => 'Todo'];
        $archivos = Archivo::where('direccion', $dato)->get();

        if ($fecha_1 != 'fecha1' && $fecha_2 != 'fecha2') {
            $fechas = ['inicio' => $fecha_1, 'fin' => $fecha_2];

            $archivos = Archivo::where('direccion', $dato)->whereBetween('fecha', [$fecha_1, $fecha_2])->get();
        }
        $pdf = Pdf::loadView('reportes.direccion_pdf', compact('archivos', 'fechas'));
        return $pdf->stream('reporte.pdf');
        /*    return view('reportes.direccion_pdf',compact('archivos','fechas')); */
    }
    public function index_coordinaciones()
    {
        $coordinaciones = Coordinacion::select('id', 'coordinacion')->get();
        return view('reportes.coordinacion', compact('coordinaciones'));
    }
    public function coordinaciones_consulta($dato, $fecha_1, $fecha_2)
    {
        $consulta = Archivo::where('coordinacion', $dato)->get();

        if ($fecha_1 != 'fecha1' && $fecha_2 != 'fecha2') {
            $consulta = Archivo::where('coordinacion', $dato)->whereBetween('fecha', [$fecha_1, $fecha_2])->get();
        }

        return response()->json($consulta);
    }
    public function coordinaciones_pdf($dato, $fecha_1, $fecha_2)
    {
        $fechas = ['inicio' => 'Todo', 'fin' => 'Todo'];
        $archivos = Archivo::where('coordinacion', $dato)->get();
        if ($fecha_1 != 'fecha1' && $fecha_2 != 'fecha2') {
            $fechas = ['inicio' => $fecha_1, 'fin' => $fecha_2];
            $archivos = Archivo::where('coordinacion', $dato)->whereBetween('fecha', [$fecha_1, $fecha_2])->get();
        }

        $pdf = Pdf::loadView('reportes.coordinacion_pdf', compact('archivos', 'fechas'));
        return $pdf->stream('reporte.pdf');
        /*    return view('reportes.direccion_pdf',compact('archivos','fechas')); */
    }


    public function etiqueta($id){
        $folder = Archivo::find($id);
        $folder_detalles = Archivos_detalles::where('referencia', $id)->get();
        $pdf = Pdf::loadView('reportes.etiqueta_pdf', compact('folder', 'folder_detalles'));
        return $pdf->stream('reporte.pdf');
       /*  return view('reportes.etiqueta_pdf', compact('folder', 'folder_detalles')); */
    }

}
