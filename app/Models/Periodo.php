<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $table = 'periodos';
    protected $fillable = [
        'periodo', 'regidor','partido'
    ];

    public function Archivos(){
        return $this->hasMany(Archivo::class);
    }
}
