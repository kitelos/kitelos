<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
            'password'              =>  'required|min:7|max:35|confirmed',
            'password_confirmation' =>  'required_if:password,>,5|max:35',
        ];
    }
}
