<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacion extends Model
{
    use HasFactory;

    protected $table = 'formacion';
    
    protected $fillable = ['denominacion', 'siglas'];

    function modulo() {
        return $this->hasMany('App\Models\Modulo', 'idformacion');
    }
}
