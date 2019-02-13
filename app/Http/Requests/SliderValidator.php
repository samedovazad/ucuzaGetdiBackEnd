<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SliderValidator extends FormRequest
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
        $id = request('id');

        return [
            'file'  =>  ($id > 0 ? '' : 'required|mimes:jpeg,jpg,png|max:1000'),
            'title' => 'required',
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'file' => 'Şekil',
            'title' => 'Başlıq',
            'description' => 'Təsvir'
        ];
    }
}
