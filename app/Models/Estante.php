<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    use HasFactory;
    protected $table = 'estantes';
    protected $fillable = [
        'codigo','numero','descripcion'
    ];

    public function Archivos(){
        return $this->hasMany(Archivo::class,'estante');
    }
}
