<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() ? false : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'email'    => 'required|email',
            'password' => 'required',
        ];

        if (has_settings('recaptcha_site_key', 'recaptcha_secret_key')) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        return $rules;
    }
}
