<?php

namespace OlympicDrive\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditUser extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['same:password']
        ];
    }
    
    public function messages() {
        return [
            'firstname.required' => 'Vous devez renseignez un prénom.',
            'lastname.required' => 'Vous devez renseignez un nom.',
            'email.required' => 'Vous devez renseignez un e-mail.',
            'password.same' => 'Vos mot de passe ne correspondent pas.',
        ];
    }
}
