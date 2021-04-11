<?php

/* Please do not change this settings if its possible. You can change this settings from admin panel */
/* You can change max_avatar_size */

/* Filepool config file */

return [
    /* Do not change if website is active and if some files are uploaded. */
    'local_folder'        => 'if', // This setting for local storage
    'aws_folder'          => 'if', // This setting for aws storage
    'user_avatars_folder' => 'avatars', // Avatars will uploading here
    'upload_folder'       => 'df', // Upload Folder for website uploads (logo,favicon,avatar etc.)
    'max_avatar_size'     => '3000', // Avatar max size

    'accepted_mimes' => [
        /* Video Files */
        'avi', 'mov', 'mp4', 'ogg', 'wmv', 'webm',
        /* Audio Files */
        'mp3', 'wav',
        /* Document Files */
        'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'odt', 'ods', 'odp', 'rtf',
        /* Image Files */
        'jpg', 'png', 'gif', 'tiff', 'ico', 'svg', 'webp', 'psd', 'ai',
        /* Other Files */
        'rar', 'csv', 'json', 'xml', 'html', 'zip', 'txt',
    ],


    'accepted_mimes_request' => [
        /* Video */
        'video/avi', 'video/x-msvideo', 'video/quicktime', 'video/x-quicktime', 'video/mp4', 'video/ogg', 'video/x-ms-wmv', 'video/x-ms-asf', 'video/webm', 'video/x-mpeg', 'video/mpeg', 'video/ogg',
        /* Audio */
        'audio/ogg', 'audio/webm', 'audio/mpeg3', 'audio/mpeg', 'audio/x-mpeg-3', 'audio/wav', 'audio/x-wav',
        /* Application */
        'application/ogg', 'application/vnd.rar', 'application/postscript', 'application/x-rar-compressed', 'application/x-rar', 'application/zip', 'application/json', 'application/xml', 'application/doc', 'application/ms-doc', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/excel', 'application/vnd.ms-excel', 'application/x-excel', 'application/x-msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/mspowerpoint', 'application/powerpoint', 'application/vnd.ms-powerpoint', 'application/x-mspowerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/pdf', 'application/vnd.oasis.opendocum', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation', 'application/rtf', 'application/vnd.oasis.opendocument.text',
        /* Image */
        'image/mov', 'image/vnd.adobe.photoshop', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'image/tiff', 'image/x-tiff', 'image/x-icon', 'image/vnd.microsoft.icon', 'image/svg+xml', 'image/webp',
        /* Text */
        'text/csv', 'text/xml', 'text/html', 'text/rtf', 'text/plain',
    ],

    /* DO NOT EDIT */
    'anonymous_user'         => [
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
        'max_file_size'         => '30', // 30 MB
        'one_time_uploads'      => '5', // 5 files in one post
        'uploads_storage'       => 'local', // "local","aws"

        /* Analytics */
        'google_analytics'      => '',

        /* Dropzone Settings */
        'dropzone_rule'         => 'Max 5 files in one time and :size limit',
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

        /* Payment Settings */
        'stripe_key'            => '',
        'stripe_secret'         => '',
        'stripe_sandbox'        => true,
    ],

    'file_expires' => [
        '1',
        '7',
        '15',
        '30',
        'never'
    ],
];
