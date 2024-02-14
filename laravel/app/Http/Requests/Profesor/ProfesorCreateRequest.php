<?php

namespace App\Http\Requests\Profesor;

use Illuminate\Foundation\Http\FormRequest;

class ProfesorCreateRequest extends FormRequest
{

    public function attributes()
    {
        return [
            'seneca_username'   => 'usuario de séneca',
            'nombre'            => 'nombre del profesor',
            'apellido1'         => 'primer apellido del profesor',
            'apellido2'         => 'segundo apellido del profesor',
            'email'             => 'email del profesor',
            'especialidad'      => 'especialidad del profesor',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    function messages() {
        $required = 'El campo :attribute es obligatorio';
        $unique = 'El nombre escrito en :attribute ya está registrado';
        $email = 'El email no tiene un formato válido';
        $max = "Te has pasado del máximo de carácteres permitidos";
        return [
            'seneca_username.required' => $required,
            'seneca_username.unique'   => $unique,
            'seneca_username.max'      => $max,

            'nombre.required'          => $required,
            'nombre.max'               => $max,

            'apellido1.required'       => $required,
            'apellido1.max'            => $max,

            'email.required'           => $required,
            'email.unique'             => $unique,
            'email.max'                => $max,
            'email.email'              => $email,

            'especialidad.required'    => $required,
            'especialidad.max'         => $max,
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'seneca_username'   => 'required|string|min:1|max:20|unique:profesor',
            'nombre'            => 'required|string|min:1|max:100',
            'apellido1'         => 'required|string|min:1|max:100',
            'apellido2'         => 'nullable|string|min:1|max:100',
            'email'             => 'required|email|min:1|max:120|unique:profesor',
            'especialidad'      => 'required|string|min:1|max:100',
        ];
    }
}
