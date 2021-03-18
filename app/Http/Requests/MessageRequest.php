<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
        $rules = [
            'name'    => 'required|max:60',
            'email'   => 'required|email|max:60',
            'subject' => 'required|max:60',
            'message' => 'required|max:350',
        ];

        if (has_settings('recaptcha_site_key', 'recaptcha_secret_key')) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        return $rules;
    }
}
