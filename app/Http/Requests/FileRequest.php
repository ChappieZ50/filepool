<?php

namespace App\Http\Requests;

use App\Rules\FileExpire;
use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file'     => 'required|file|mimetypes:' . get_accepted_mimes() . '|max:' . get_file_limit(false),
            'expire'   => ['required', new FileExpire],
            'storage'  => '',
            'password' => 'sometimes|max:100',
        ];

        if (has_settings('recaptcha_site_key', 'recaptcha_secret_key') && !auth()->check()) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        return $rules;
    }
}
