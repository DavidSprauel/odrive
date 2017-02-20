<?php

namespace OlympicDrive\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUser extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    public function rules()
    {
        return [
            'firstname' => ['required', 'alpha'],
            'lastname' => ['required', 'alpha'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'same:password_conf']
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
        ];
    }
}
