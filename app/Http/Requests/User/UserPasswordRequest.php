<?php

namespace App\Http\Requests\User;

use App\Rules\ConfirmPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required',new ConfirmPassword()],
            'password'         => 'required|min:8|max:24|confirmed',
        ];
    }
}
