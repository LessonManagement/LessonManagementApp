<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupo';
    
    protected $fillable = ['curso_escolar', 'idformacion', 'curso', 'horas', 'especialidad'];

    // Consultar como hacer la relación muchos a muchos
    function formaciones() {
        return $this->hasMany('App\Models\Formacion', 'idformacion');
    }
    // Lecciones
    function lecciones() {
        return $this->hasMany('App\Models\Leccion', 'idgrupo');
    }
}
