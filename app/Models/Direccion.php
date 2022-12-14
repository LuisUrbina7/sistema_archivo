<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $table = 'direcciones';
    protected $fillable = [
        'direccion', 'encargado','idUsuario'
    ];
    public function Usuario(){
        return $this->belongsTo(User::class,'idUsuario');
    }
    public function Archivos(){
        return $this->hasMany(Archivo::class);
    }
}
