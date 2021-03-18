<?php

/* Please do not change this settings if its possible. You can change this settings from admin panel */
/* You can change max_avatar_size */

/* Imgpool config file */

return [
    /* Do not change if website is active and if some files are uploaded. */
    'local_folder'        => 'if', // This setting for local storage
    'user_avatars_folder' => 'avatars', // Avatars will uploading here
    'aws_folder'          => 'if', // This setting for aws storage
    'upload_folder'       => 'df', // Upload Folder for website uploads (logo,favicon,avatar etc.)
    'max_avatar_size'     => '3000', // Avatar max size

    /* DO NOT EDIT */
    'accepted_mimes'      => 'jpeg,jpg,png,svg,gif',
    'anonymous_user'      => [
        'username'     => 'Anonymous',
        'avatar'       => '',
        'email'        => '',
        'status'       => true,
        'is_admin'     => false,
        'is_anonymous' => true
    ],
    /* DO NOT EDIT */


    'settings' => [
        /* Website Settings */
        'website_name'          => 'Imgpool',
        'menu_title'            => 'About',
        'theme_color'           => '#2c7ce0',

        /* SEO */
        'site_title'            => 'Imgpool',
        'site_description'      => 'Imgpool',
        'site_keywords'         => 'imgpool,upload image',

        /* Upload Settings */
        'max_file_size'         => '5', // 5 MB
        'one_time_uploads'      => '5', // 5 images in one post
        'uploads_storage'       => 'local', // "local","aws"

        /* Analytics */
        'google_analytics'      => '',

        /* Dropzone Settings */
        'dropzone_rule'         => 'Max 5 files in one time and JPG,PNG,GIF,SVG are accepted, 25MB limit',
        'dropzone_text'         => 'Drop files here, paste or %{browse}',
        'browse_text'           => 'browse files',

        /* AWS Settings */
        'aws_access_key'        => env('AWS_ACCESS_KEY_ID', ''),
        'aws_secret_access_key' => env('AWS_SECRET_ACCESS_KEY', ''),
        'aws_region'            => env('AWS_DEFAULT_REGION', ''),
        'aws_bucket'            => env('AWS_BUCKET', ''),

        /* Login Settings */
        'google_client_id'      => '',
        'google_secret'         => '',
        'facebook_client_id'    => '',
        'facebook_secret'       => '',
        'recaptcha_site_key'    => '',
        'recaptcha_secret_key'  => '',
    ],

];
