<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileDownloadRequest extends FormRequest
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
            'id'       => 'required',
            'password' => 'sometimes'
        ];

        if (has_settings('recaptcha_site_key', 'recaptcha_secret_key')) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        return $rules;
    }
}
