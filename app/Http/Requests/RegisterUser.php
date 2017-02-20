<?php

namespace OlympicDrive\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'firstname' => ['required', 'alpha'],
            'lastname' => ['required', 'alpha'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'same:password_conf'],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
            'zipcode' => ['required', 'numeric'],
            'city' => ['required'],
        ];
    }
    
    public function messages() {
        return [
            'firstname.required' => 'Vous devez renseignez un prénom.',
            'lastname.required' => 'Vous devez renseignez un nom.',
            'email.required' => 'Vous devez renseignez un e-mail.',
            'password.required' => 'Vous devez renseignez un mot de passe.',
            'password.same' => 'Vos mot de passe ne correspondent pas.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'phone.required' => 'Vous devez renseignez un numéro de téléphone.',
            'phone.numeric' => 'Le format du téléphone n\'est pas valide',
            'address.required' => 'Vous devez renseignez une adresse.',
            'zipcode.required' => 'Vous devez renseignez un code postal.',
            'zipcode.numeric' => 'Le format du code postal n\'est pas valide.',
            'city.required' => 'Vous devez renseignez une ville.',
        ];
    }
}
