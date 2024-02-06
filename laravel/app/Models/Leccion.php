<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'leccion';
    
    protected $fillable = ['idgrupo', 'idmodulo', 'idprofesor', 'horas'];

    // Relaciones
    // Grupo
    function grupo() {
        return $this->belongsTo('App\Models\Grupo', 'idgrupo');
    }
    // modulo
    function modulo() {
        return $this->belongsTo('App\Models\Modulo', 'idmodulo');
    }
    // profesor
    function profesor() {
        return $this->belongsTo('App\Models\Profesor', 'idprofesor');
    }
}
