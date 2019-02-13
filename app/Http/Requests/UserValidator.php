<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserValidator extends FormRequest
{
    public $validator = null;

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }

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
        return [
            'name'     => 'required',
            'surname'  => 'required',
            'email'    => 'required',
            'password' => 'required',
            'birthday' => 'required',
            'gender'   => 'required',
            'fphone'   => 'required',
            'username' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'    => 'Ad',
            'surname' => 'Soyad',
            'email'   => 'E-mail',
            'password' => 'Parol',
            'birthday' => 'Doğum tarixi',
            'gender'   => 'Cinsi',
            'fphone'   => 'Telefon nömrəsi',
            'username' => 'İstifadəçi adı'
        ];
    }
}
