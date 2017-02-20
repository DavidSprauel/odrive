<?php

namespace OlympicDrive\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBasket extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->isAdminOrEditor();
    }
    
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'picture' => 'max:2000|image',
        ];
    }
    
    public function messages() {
        return [
            'name.required' => 'Vous devez nommer votre panier.',
            'description.required' => 'Vous devez decrire votre panier.',
            'price.required' => 'Vous devez renseigner un prix pour votre panier.',
            'price.float' => 'Le prix doit être un nombre (si décimal utilisez le ".").',
        ];
    }
}
