<?php

namespace App\Http\Requests\Api\Weather;

use Illuminate\Foundation\Http\FormRequest;

class GetByCoordinatesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lat' => 'required|numeric|between:-90,90',
            'lon' => 'required|numeric|between:-180,180',
        ];
    }
}
