<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AuctionValidator extends FormRequest
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
            'files'         => 'required',
            'title'         => 'required',
            'category'      => 'required',
            'sub_category'  => 'required',
            'start_price'   => 'numeric',
            'reserve_price'     => 'numeric',
            'increment_price'   => 'numeric',
            'region'            => 'required',
            'city'              => 'required',
            'endDay'            => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'files' => 'Şekil',
            'title' => 'Başlıq',
            'category'        => 'Kateqoriya',
            'sub_category'    => 'Alt Kateqoriya',
            'start_price'     => 'Başlanma qiyməti',
            'reserve_price'   => 'Minimal satiş qiyməti',
            'increment_price' => 'Artim qiyməti',
            'region'          => 'Ölkələr seçin',
            'city'            => 'Şəhər seçin',
            'endDay'          => 'Bitmə tarixi',
        ];
    }
}
