<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacion extends Model
{
    use HasFactory;

    protected $table = 'formacion';
    
    protected $fillable = ['denominacion', 'siglas'];

    // Relación belongstomany tabla pivot grupo_formacion
    function grupos() {
        return $this->belongsToMany('App\Grupo', 'grupo_formacion', 'idformacion', 'idgrupo')
            ->withTimestamps();
    }

    // Relación belongstomany tabla pivot modelo_formacion
    function modulos() {
        return $this->belongsToMany('App\Modulo', 'grupo_formacion', 'idformacion', 'idmodulo')
            ->withTimestamps();
    }
}
