<?php

namespace OlympicDrive\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCart extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $exists = $this->input('type') == 1 ? 'exists:products,id' : 'exists:baskets,id';
        return [
            'product' => ['required', $exists, 'integer'],
            'quantity' => ['required', 'integer'],
            'type' => ['required', 'in:1,2'] // 1 = products, 2 = paniers
        ];
    }
}
