<?php

namespace App\Http\Requests\Profesor;

use App\Http\Requests\Profesor\ProfesorCreateRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfesorEditRequest extends ProfesorCreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['seneca_username'] = 'required|string|min:1|max:20|unique:profesor,seneca_username,' . $this->profesor->id;
        $rules['email'] = 'required|email|min:1|max:120|unique:profesor,email,' . $this->profesor->id;
        return $rules;
    }
}
