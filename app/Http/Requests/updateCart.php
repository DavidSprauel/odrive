<?php

namespace OlympicDrive\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCart extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'products' => 'required|array'
        ];
    }
}
