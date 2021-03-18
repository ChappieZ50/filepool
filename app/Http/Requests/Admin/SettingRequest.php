<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            /* Website */
            'website_name'          => 'sometimes',
            'google_analytics'      => 'sometimes',
            'max_file_size'         => 'sometimes',
            'one_time_uploads'      => 'sometimes',
            'uploads_storage'       => 'sometimes|in:local,aws',
            'dropzone_text'         => 'sometimes',
            'browse_text'           => 'sometimes',
            'dropzone_rule'         => 'sometimes',
            'menu_title'            => 'sometimes',
            'theme_color'           => 'sometimes',

            /* AWS API */
            'aws_access_key'        => 'sometimes',
            'aws_secret_access_key' => 'sometimes',
            'aws_region'            => 'sometimes',
            'aws_bucket'            => 'sometimes',

            /* Login & Recaptcha API */
            'google_client_id'      => 'sometimes',
            'google_secret'         => 'sometimes',
            'facebook_client_id'    => 'sometimes',
            'facebook_secret'       => 'sometimes',
            'recaptcha_site_key'    => 'sometimes',
            'recaptcha_secret_key'  => 'sometimes',

            /* Logo & Favicon */
            'logo'                  => 'sometimes|image|mimes:jpeg,jpg,png,svg|max:5000',
            'favicon'               => 'sometimes|mimes:jpeg,jpg,png,svg,ico|max:5000',
            'favicon_mime'          => 'sometimes|max:10',

            /* Seo */
            'site_title'            => 'sometimes',
            'site_description'      => 'sometimes',
            'site_keywords'         => 'sometimes',
        ];
    }
}
