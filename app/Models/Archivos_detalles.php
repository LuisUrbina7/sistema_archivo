<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos_detalles extends Model
{
    use HasFactory;
   
    protected $table = 'archivos_detalles';
    protected $fillable = [
        'referencia', 'documento','folios','solicitud','ap'
    ];

    public function Archivo(){
        return $this->belongsTo(Archivo::class,'referencia');
    }
}
