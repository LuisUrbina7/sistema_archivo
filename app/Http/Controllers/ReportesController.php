<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Direccion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index_direcciones(){
        $direcciones = Direccion::select('id','direccion')->get();
        return view('reportes.direccion',compact('direcciones'));
    }
    public function direcciones_consulta($dato,$fecha_1,$fecha_2){
      
        $consulta = Archivo::where('direccion',$dato)->whereBetween('fecha',[$fecha_1,$fecha_2])->get();

       return response()->json($consulta);
    }
    public function direcciones_pdf($dato,$fecha_1,$fecha_2){
       $fechas = ['inicio'=>$fecha_1,'fin'=>$fecha_2];
        $archivos = Archivo::where('direccion',$dato)->whereBetween('fecha',[$fecha_1,$fecha_2])->get();

        $pdf = Pdf::loadView('reportes.direccion_pdf',compact('archivos','fechas'));
        return $pdf->stream('reporte.pdf');
     /*    return view('reportes.direccion_pdf',compact('archivos','fechas')); */
    }
}
