<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'modulo';
    
    protected $fillable = ['idformacion', 'denominacion', 'siglas', 'curso', 'horas', 'especialidad'];
    
    // Relación belongstomany tabla pivot modelo_formacion
    function formaciones() {
        return $this->belongsToMany('App\Models\Formacion', 'modulo_formacion', 'idmodulo', 'idformacion')
            ->withTimestamps();
    }

    // Lecciones
    function lecciones() {
        return $this->hasMany('App\Models\Leccion', 'idmodulo');
    }
}
