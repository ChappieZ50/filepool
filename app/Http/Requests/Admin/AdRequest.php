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
            'home_left'   => 'sometimes',
            'home_right'  => 'sometimes',
            'file_left'   => 'sometimes',
            'file_bottom' => 'sometimes',
            'mobile'      => 'sometimes',
        ];
    }
}
