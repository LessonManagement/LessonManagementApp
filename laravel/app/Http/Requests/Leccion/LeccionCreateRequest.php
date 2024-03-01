<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeccionCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return [
            'idgrupo' => 'id del grupo',
            'idmodulo' => 'id del módulo',
            'idprofesor' => 'id del profesor asociado',
            'horas' => 'horas de la lección',
        ];
    }

    function messages()
    {
        $required = 'El campo :attribute es obligatorio';
        $integer = 'El campo :attribute tiene que ser un número entero.';
        $exist = 'El :attribute proporcionado no existe';
        return [
            'idgrupo.required' => $required,
            'idmodulo.required' => $required,
            'horas.required' => $required,
            'idgrupo.integer' => $integer,
            'idmodulo.integer' => $integer,
            'idprofesor.integer' => $integer,
            'horas.integer' => $integer,
            'idgrupo.exists' => $exist,
            'idprofesor.exists' => $exist,
            'idmodulo.exists' => $exist
        ];
    }

    public function rules(): array
    {
        return [
            'idgrupo' => 'required|integer|exists:grupo,id',
            'idmodulo' => 'required|integer|exists:modulo,id',
            'idprofesor' => 'integer|exists:profesor,id',
            'horas' => 'required|integer',
        ];
    }
}
