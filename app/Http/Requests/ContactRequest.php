<?php

namespace OlympicDrive\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'firstname' => ['required'],
            'lastname'  => ['required'],
            'email'     => ['required', 'email'],
            'subject'   => ['required'],
            'message'   => ['required'],
        ];
    }
    
    public function messages() {
        return [
            'firstname.required' => 'Vous devez renseigner un prénom',
            'lastname.required'  => 'Vous devez renseigner un nom',
            'email.required'     => 'Vous devez renseigner un email',
            'email.email'        => 'Votre email n\'est pas valide',
            'subject.required'   => 'Vous devez renseigner un sujet',
            'message.required'   => 'Vous devez renseigner un message',
        ];
    }
}
