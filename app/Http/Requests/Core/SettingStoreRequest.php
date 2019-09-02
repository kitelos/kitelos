<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

class SettingStoreRequest extends FormRequest
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
            'key'   =>  'min:3|max:255|required|unique:settings,key',
            'value' =>  'required|min:3'
        ];
    }
}
