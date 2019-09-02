<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'name'  =>  'min:3|max:170|required',
            'slug'  =>  'min:3|max:100|required|unique:roles,slug,'.$this->route('role'),
            'description'   =>  'max:255'
        ];
    }
}
