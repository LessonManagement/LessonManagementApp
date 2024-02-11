<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupo';
    
    protected $fillable = ['curso_escolar', 'idformacion', 'curso', 'horas', 'especialidad'];

    // Relación belongstomany tabla pivot grupo_formacion
    function formaciones() {
        return $this->belongsToMany('App\Models\Formacion', 'grupo_formacion', 'idgrupo', 'idformacion')
            ->withTimestamps();
    }
    // Lecciones
    function lecciones() {
        return $this->hasMany('App\Models\Leccion', 'idgrupo');
    }
}
