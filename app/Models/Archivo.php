<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    
    use HasFactory;
    protected $table = 'archivos';
    protected $fillable = [
        'direccion', 'coordinacion','instituto','año','folder','responsable','recibido','fecha','color','observaciones',
    ];
    public function Detalles(){
        return $this->hasMany(Archivos_detalles::class);
    }
}
