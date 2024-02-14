<?php

namespace App\Http\Requests\grupo;

use Illuminate\Foundation\Http\FormRequest;

class GrupoCreateRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'curso_escolar'     => 'Periodo escolar',
            'idformacion'       => 'Denominaacion de la fomacion',
            'curso'             => 'No sabemos que es todavia',
            'denominacion'      => 'Nombre del grupo',
            'turno'             => 'Turno de mañana tarde',
            ];
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }
    public function menssages()
    {
        $integer = 'EL campo :attribute tiene que ser un número entero.';
        $decimal = 'EL campo :attribute tiene que ser un número con un maximo de :decimal decimales.';
        $gte = 'EL valor minimo del campo :attribute es :gte.';
        $lte = 'EL valor maximo del campo :attribute es :lte.';
        $required = 'EL campo :attribute es obligatorio.';
        return [
            'curso_escolar.integer'   => $integer,
            'curso_escolar.gte'       => $gte,
            'curso_escolar.lte'       => $lte,
            'curso_escolar.required'       => $required,
            
            'idformacion.required'     => $required,
            
            'curso.integer'        => $integer,
            'curso.gte'            => $gte,
            'curso.lte'            => $lte,
            'curso.required'       => $required,
            
            'denominacio.required'    => $required,
            'denominacion.unique'     => 'EL nombre tiene que ser unico',

            'turno.required'     => $required,
            
            
            ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                        //obligatorio|tipo|rango
            'curso_escolar'     => 'required|gte:2000|lte:2050',
            'denominacion'      => 'required|string|min:3|unique:grupo,denominacion,',
            'idformacion'       => 'required',
            'curso'             => 'required',
            'turno'             => 'required'
        ];
    }
}
