<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    
    use HasFactory;
    protected $table = 'archivos';
    protected $fillable = [
        'direccion', 'coordinacion','instituto','año','folder','responsable','recibido','fecha','color','observaciones','estante','periodo'
    ];
    public function Detalles(){
        return $this->hasMany(Archivos_detalles::class);
    }
    public function Direccion(){
        return $this->belongsTo(Direccion::class,'direccion');
    }
    public function Coordinacion(){
        return $this->belongsTo(Coordinacion::class,'coordinacion');
    }
    public function Periodo(){
        return $this->belongsTo(Periodo::class,'periodo');
    }
    public function Usuario(){
        return $this->belongsTo(User::class,'recibido');
    }
    public function Estante(){
        return $this->belongsTo(Estante::class,'estante');
    }
}
