<?php

/* Please do not change this settings if its possible. You can change this settings from admin panel */
/* You can change max_avatar_size */

/* Filepool config file */

return [
    /* Do not change if website is active and if some files are uploaded. */
    'local_folder'        => 'if', // This setting for local storage
    'user_avatars_folder' => 'avatars', // Avatars will uploading here
    'aws_folder'          => 'if', // This setting for aws storage
    'upload_folder'       => 'df', // Upload Folder for website uploads (logo,favicon,avatar etc.)
    'max_avatar_size'     => '3000', // Avatar max size

    /* DO NOT EDIT */
    'accepted_mimes'      => [
        /* Image */
        'image/jpeg'                                                              => 'jpeg',
        'image/jpg'                                                               => 'jpg',
        'image/png'                                                               => 'png',
        'image/gif'                                                               => 'gif',

        /* Application */
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'application/msword'                                                      => 'doc',
        'application/vnd.ms-excel'                                                => 'xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'       => 'xlsx',
        'application/vnd.android.package-archive'                                 => 'apk',
        'application/zip'                                                         => 'zip',
        'application/x-rar'                                                       => 'rar',

        /* Text */
        'text/csv'                                                                => 'csv',
        'text/plain'                                                              => 'txt',

        /* Video */
        'video/mp4'                                                               => 'mp4',
        'video/x-m4v'                                                             => 'm4v',
        'video/x-ms-wmv'                                                          => 'wmv',

        /* Audio */
        'audio/mpeg'                                                              => 'mp3',
        'audio/mp4'                                                               => 'm4a',
        'audio/x-wav'                                                             => 'wav',

    ],

    'anonymous_user' => [
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
        'website_name'          => 'Filepool',
        'menu_title'            => 'About',
        'theme_color'           => '#d3059d',

        /* SEO */
        'site_title'            => 'Filepool',
        'site_description'      => 'Filepool',
        'site_keywords'         => 'filepool,upload image',

        /* Upload Settings */
        'max_file_size'         => '5', // 5 MB
        'one_time_uploads'      => '5', // 5 images in one post
        'uploads_storage'       => 'local', // "local","aws"

        /* Analytics */
        'google_analytics'      => '',

        /* Dropzone Settings */
        'dropzone_rule'         => 'Max 5 files in one time and 25MB limit',
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
