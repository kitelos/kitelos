<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        dd($this->route('user'));
        dd($this->route('profile'));

        return [
            'name'  =>  'min:3|max:170|required',
            'email' =>  'email|max:100|required|unique:users,email,'.$this->route('user') ? $this->route('user') : $this->route('profile'),
        ];
    }
}
