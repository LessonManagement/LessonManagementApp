<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'modulo';
    
    protected $fillable = ['idformacion', 'denominacion', 'siglas', 'curso', 'horas', 'especialidad'];
    
    function formacion() {
        return $this->belongsTo('App\Models\Formacion', 'idformacion');
    }

    // Lecciones
    function lecciones() {
        return $this->hasMany('App\Models\Leccion', 'idmodulo');
    }
}
