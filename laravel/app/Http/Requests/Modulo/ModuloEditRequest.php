<?php

namespace App\Http\Requests\Modulo;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Modulo\ModuloCreateRequest;

class ModuloEditRequest extends ModuloCreateRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        return $rules;
    }
}
