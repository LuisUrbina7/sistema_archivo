<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinacion extends Model
{
    use HasFactory;
    protected $table = 'coordinaciones';
    protected $fillable = [
        'coordinacion', 'encargado','idUsuario'
    ];
    public function Usuario(){
        return $this->belongsTo(User::class,'idUsuario');
    }
    public function Archivos(){
        return $this->hasMany(Archivo::class);
    }
}
