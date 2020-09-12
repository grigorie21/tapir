<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class AdPostRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'max:200',
            'description' => 'max:1000',
//            'cost',
            'images' => 'between:1,3',
        ];
    }
}
