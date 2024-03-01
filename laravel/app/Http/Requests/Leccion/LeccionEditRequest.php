<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Leccion\LeccionCreateRequest;

class LeccionEditRequest extends LeccionCreateRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        return $rules;
    }
}
