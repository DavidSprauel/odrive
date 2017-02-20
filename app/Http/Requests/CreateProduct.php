<?php

namespace OlympicDrive\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->isAdminOrEditor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'picture' => 'image|max:2000'
        ];
    }
    
    public function messages() {
        return [
            'name.required' => 'Vous devez renseigner un nom.',
            'weight.required' => 'Vous devez renseigner un poid',
            'weight.numeric' => 'Le poid doit être un nombre entier.',
            'price.required' => 'Vous devez renseigner un prix.',
            'price.numeric' => 'Le prix doit être un nombre (séparé par un . si chiffre non rond).',
            'picture.image' => 'Ce fichier n\'est pas une image.' ,
            'picture.max' => 'Ce fichier est trop lourd.'
        ];
    }
}
