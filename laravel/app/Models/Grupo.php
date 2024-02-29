<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupo';
    
    protected $fillable = ['curso_escolar', 'idformacion', 'curso', 'denominacion','turno' ];

    // Relación belongsTo formacion
    function formacion() {
        return $this->belongsTo('App\Models\Formacion', 'idformacion');
    }

    // Lecciones
    function lecciones() {
        return $this->hasMany('App\Models\Leccion', 'idgrupo');
    }
}
