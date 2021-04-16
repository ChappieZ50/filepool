<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'username'      => 'required|min:4|max:50|string',
            'email'         => [
                'required', 'email', 'min:6', Rule::unique('users')->ignore($this->user->id)
            ],
            'storage_limit' => 'required|min:0|integer',
            'is_admin'      => 'sometimes|accepted',
            'is_premium'    => 'sometimes|accepted',
        ];
    }
}
