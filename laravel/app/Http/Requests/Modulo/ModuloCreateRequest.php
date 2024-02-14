<?php

namespace App\Http\Requests\Modulo;

use Illuminate\Foundation\Http\FormRequest;

class ModuloCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return [
            'denominacion' => 'denominación del modulo',
            'idformacion' => 'id de la formación',
            'siglas' => 'siglas del módulo',
            'curso' => 'curso del módulo',
            'horas' => 'horas del módulo',
            'especialidad' => 'especialidad del profesor',
        ];
    }

    function messages()
    {
        $required = 'El campo :attribute es obligatorio';
        $integer = 'El campo :attribute tiene que ser un número entero.';
        $gte = 'El valor mínimo del campo :attribute es :value.';
        $max = 'La longitud máxima del campo :attribute es :max caracteres.';
        return [
            'denominacion.required' => $required,
            'denominacion.max' => $max,
            'idformacion.required' => $required,
            'idformacion.integer' => $integer,
            'siglas.required' => $required,
            'siglas.max' => $max,
            'curso.required' => $required,
            'curso.integer' => $integer,
            'curso.gte' => $gte,
            'horas.required' => $required,
            'horas.integer' => $integer,
            'horas.gte' => $gte,
            'especialidad.required' => $required,
            'especialidad.max' => $max
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
            'denominacion' => 'required|string|max:100',
            'idformacion' => 'required|integer',
            'siglas' => 'required|string|max:10',
            'curso' => 'required|integer|gte:1',
            'horas' => 'required|integer|gte:1',
            'especialidad' => 'required|string|max:100',
        ];
    }
}
