<?php

namespace OlympicDrive\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ValidateOrder extends FormRequest
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
    
    public function rules()
    {
        if(Auth::check()) {
            $unique = Auth::user()->email != $this->input('email') ? 'unique:users,email' : '';
        } else {
            $unique = 'unique:users,email';
        }
        
        return [
            'firstname' => ['required', 'alpha'],
            'lastname' => ['required', 'alpha'],
            'email' => ['required', 'email', $unique ],
            'password' => ['same:password_conf, required_if:account'],
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
