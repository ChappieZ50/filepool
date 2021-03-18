<?php

namespace App\Http\Requests;

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
        return [
            'file' => 'required|file|mimetypes:' . arr_to_str(get_mimes(false,json_decode(get_setting('dropzone_accepted_mimes'))),false) . 'max:' . get_setting('max_file_size') * 1000,
        ];
    }
}
