<?php

namespace OlympicDrive\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInfos extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }
    
    public function rules()
    {
        $unique = Auth::user()->email != $this->input('email') ? ',unique:users, email' : '';
        return [
            'firstname' => ['required', 'alpha'],
            'lastname' => ['required', 'alpha'],
            'email' => ['required', 'email'.$unique ],
            'password' => ['same:password_conf'],
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
