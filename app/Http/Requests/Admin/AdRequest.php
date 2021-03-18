<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'home_top_ad'    => 'sometimes',
            'home_bottom_ad' => 'sometimes',
            'file_left_ad'   => 'sometimes',
            'file_bottom_ad' => 'sometimes',
            'mobile_ad'      => 'sometimes',
            'download_ad'    => 'sometimes',
        ];
    }
}
