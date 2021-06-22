<?php

return [
    /* Controller Messages */
    'front' => [
        'expire'            => 'Expire',
        'product'           => [
            'success'   => 'Your payment successful',
            'not_found' => 'Product not found',
        ],
        'message'           => [
            'success' => 'Your message has been sent successfully',
            'error'   => 'Something gone wrong, please try again',
        ],
        'user'              => [
            'profile_update'  => 'Your information successfully updated',
            'password_update' => 'Your password successfully updated',
            'avatar_update'   => 'Your avatar successfully updated',
            'avatar_delete'   => 'Your avatar successfully deleted',
        ],
        'account_banned'    => 'Your account has been banned',
        'account_exists'    => 'User already exists. Sign in with email password',
        'account_incorrect' => 'Email or password is incorrect',
    ],

    'back'                    => [
        'settings' => [
            'payment_success'         => 'Payment successfully updated',
            'seo_success'             => 'SEO successfully updated',
            'login_recaptcha_success' => 'Login & Recaptcha Api successfully updated',
            'aws_api_success'         => 'AWS API successfully updated',
            'logo_favicon_success'    => 'Logo & favicon successfully updated',
            'website_success'         => 'Website Settings successfully updated',
        ],
        'product'  => [
            'delete_success' => 'Product successfully deleted',
            'update_success' => 'Product successfully updated',
            'store_success'  => 'Product successfully created',
        ],
        'page'     => [
            'delete_success' => 'Page successfully deleted',
            'update_success' => 'Page successfully updated',
            'store_success'  => 'Page successfully created',
        ],
        'message'  => [
            'delete_success' => 'Message successfully deleted',
        ],
        'file'     => [
            'delete_success' => 'File successfully deleted',
        ],
        'ad'       => [
            'update_success' => 'Ads successfully updated',
        ],
        'user'     => [
            'avatar_delete_success' => 'Avatar successfully deleted',
            'status_success'        => 'Status successfully changed',
            'admin_ban_error'       => 'Admin user cannot ban',
            'create_success'        => 'User Created',
            'update_success'        => 'User successfully updated',
        ]
    ],
    'server_error'            => 'Something gone wrong',
    'payment_success_text'    => 'Your payment successful',
    'payment_error_text'      => 'For some reason your payment failed',
    'password_incorrect'      => 'Password Incorrect',
    'storage_full'            => 'Your storage is full, you should buy storage',
    'file_not_found'          => 'File Not Found',
    'product_not_found'       => 'There was a problem, the product was not found',
    'file_delete_success'     => 'File Successfully Deleted',

    /* Website */
    'website'                 => [
        'register' => [
            'back'             => 'homepage',
            'sign_up_with'     => 'Sign up With',
            'username'         => 'Username',
            'email'            => 'Email Address',
            'password'         => 'Password',
            'password_confirm' => 'Confirm Password',
            'sign_up'          => 'Sign Up',
            'already_account'  => 'Already have an account ?',
            'sign_in'          => 'Sign In',
            'or'               => 'OR',
        ],
        'product'  => [
            'empty'               => 'Products not added yet',
            'premium_user'        => 'Premium User',
            'store_files_forever' => 'Store Files Forever',
            'no_ads'              => 'No Ads',
            'increase_storage'    => 'increase storage',
            'purchased'           => 'Purchased',
            'purchased_response'  => 'You already have this product',
            'buy_now'             => 'Buy Now',
            'payment'             => 'Payment',
            'card_name'           => 'Name on Card',
            'card_number'         => 'Card Number',
            'cvc'                 => 'CVC',
            'mm'                  => 'MM',
            'yyyy'                => 'YYYY',
            'expiration_month'    => 'Expiration Month',
            'expiration_year'     => 'Expiration Year',
            'pay'                 => 'Pay',
            'loading'             => 'Loading...',
        ],
        'contact'  => [
            'name'    => 'Your Name',
            'email'   => 'Your Email',
            'subject' => 'Subject',
            'message' => 'Message',
            'send'    => 'Send Message'
        ],
        'login'    => [
            'back'         => 'homepage',
            'sign_in_with' => 'Sign in With',
            'email'        => 'Email Address',
            'password'     => 'Password',
            'sign_in'      => 'Sign In',
            'no_account'   => 'Don\'t have an account',
            'sign_up'      => 'Register',
            'or'           => 'OR',
        ],
        'home'     => [
            'buy_storage' => 'Buy Storage',
            'dropzone'    => [
                'rule_text' => 'By creating a file, you agree',
                'and'       => 'and',
            ],

            'sidebar' => [
                'sign_in'     => 'Sign In',
                'sign_up'     => 'Sign Up',
                'profile'     => 'Profile',
                'my_files'    => 'My Files',
                'statistics'  => 'Statistics',
                'payments'    => 'Payments',
                'admin_panel' => 'Admin Panel',
                'logout'      => 'Logout',
            ],
        ],
        'file'     => [
            'own_file' => 'This is your file, you can download without password',
            'download' => 'Download',
        ],
        'user'     => [
            'sidebar'      => [
                'profile'       => 'Profile',
                'my_files'      => 'My Files',
                'statistics'    => 'Statistics',
                'payments'      => 'Payments',
                'admin_panel'   => 'Admin Panel',
                'logout'        => 'Logout',
                'storage_limit' => 'Storage Limit:',

            ],
            'files'        => [
                'title'         => 'My Files',
                'all'           => 'All',
                'never'         => 'Never',
                '30'            => '30D',
                '15'            => '15D',
                '7'             => '7D',
                '1'             => '1D',
                'not_found'     => 'No Files Found',
                'upload'        => 'You can upload some files from :here',
                'view'          => 'View',
                'download'      => 'Download',
                'show_password' => 'Show Password',
                'delete'        => 'Delete File',
                'click_to_copy' => 'Click here to copy',
                'share_with'    => 'Share With',
                'share_link'    => 'File Share Link'
            ],
            'profile'      => [
                'title'                => 'Profile Information',
                'email'                => 'Email Address',
                'username'             => 'Username',
                'user_update_profile'  => 'Update',
                'security_title'       => 'Security Information',
                'current_password'     => 'Current Password',
                'new_password'         => 'New Password',
                'new_password_confirm' => 'Confirm New Password',
                'user_update_password' => 'Update',
                'user_update_avatar'   => 'Update Avatar'
            ],
            'statistics'   => [
                'title'          => 'Statistics',
                'uploaded_files' => 'Monthly Uploaded Files',
                'storage_usage'  => 'Monthly Storage Usage',
                'empty'          => 'Empty statistics',
                'upload'         => 'You can upload some files from :here',
            ],
            'transactions' => [
                'title'   => 'Payments',
                'empty'   => 'No Payment Found',
                'id'      => '#ID',
                'name'    => 'Product Name',
                'price'   => 'Price',
                'method'  => 'Payment Method',
                'status'  => 'Status',
                'created' => 'Created',
                'success' => 'Success',
                'failed'  => 'Failed',
            ]
        ],
        '404'      => [
            'title' => 'Page Not Found',
            'back'  => 'Back to home'
        ],
    ],

    /* Admin Panel */
    'admin'                   => [

        /* Pages */
        'settings'     => [
            'title'       => 'Settings',
            'save_button' => 'Save Settings',
            'cards'       => [
                'website'         => [
                    'card_title' => 'Website',
                    'website'    => [
                        'title'                   => 'Website Settings',
                        'name'                    => 'Website Name',
                        'google_analytics_id'     => 'Google Analytics ID',
                        'max_file_size'           => 'Max File Size (MB)',
                        'max_file_size_default'   => 'Ex: 100MB limit and 5 one time uploads | 1 file limit is 20MB',
                        'one_time_uploads'        => 'One Time Uploads',
                        'menu_title'              => 'Menu Title',
                        'uploads_storage'         => 'Uploads Storage',
                        'local_storage'           => 'Local Storage',
                        'aws_storage'             => 'AWS Storage',
                        'uploads_storage_default' => 'Default: Local Storage',
                        'theme_color'             => 'Theme Color',
                        'theme_color_default'     => 'Default: #d3059d',
                    ],
                    'dropzone'   => [
                        'title'                 => 'Dropzone Settings',
                        'text'                  => 'Dropzone Text',
                        'text_default'          => 'add this attribute in your text:',
                        'text_default_2'        => 'Ex: Drop files here, paste or, %{browse}',
                        'browse_attribute_text' => 'Browse Attribute Text',
                        'rule_text'             => 'Dropzone Rule Text',
                        'rule_text_default'     => 'Ex: Max 5 files in one time and :size limit',
                    ]

                ],
                'logo_favicon'    => [
                    'card_title'          => 'Logo & Favicon',
                    'title'               => 'Logo & Favicon',
                    'choose_logo'         => 'Choose Logo',
                    'logo_recommended'    => 'Recommended: 135x45',
                    'choose_favicon'      => 'Choose Favicon',
                    'favicon_recommended' => 'Recommended: 60x60',
                ],
                'aws_api'         => [
                    'card_title'        => 'AWS API',
                    'title'             => 'Amazon Web Services API',
                    'info'              => 'You can get your info from :here',
                    'access_key'        => 'Access Key',
                    'secret_access_key' => 'Secret Access Key',
                    'region'            => 'Region',
                    'bucket'            => 'Bucket',
                    'warning'           => 'Please enter all information',

                ],
                'login_recaptcha' => [
                    'card_title' => 'Login & Recaptcha API',
                    'title'      => 'Google & Facebook & Recaptcha',
                    'google'     => [
                        'title'      => 'Google Login Information',
                        'client_id'  => 'Client ID',
                        'secret_key' => 'Secret Key',
                        'callback'   => 'Add this to your api callback: :callback'
                    ],
                    'facebook'   => [
                        'title'      => 'Facebook Login Information',
                        'client_id'  => 'Client ID',
                        'secret_key' => 'Secret Key',
                        'callback'   => 'Add this to your api callback: :callback'
                    ],
                    'recaptcha'  => [
                        'title'      => 'Recaptcha Information',
                        'warning'    => 'Please use V2 recaptcha',
                        'site_key'   => 'Site Key',
                        'secret_key' => 'Secret Key',

                    ]
                ],
                'seo'             => [
                    'card_title'       => 'SEO',
                    'title'            => 'SEO',
                    'site_title'       => 'Site Title',
                    'site_description' => 'Site Description',
                    'site_keywords'    => 'Site Keywords',
                ],
                'payment'         => [
                    'card_title'             => 'Payment',
                    'title'                  => 'Iyzico',
                    'iyzico_api_key'         => 'Iyzico API Key',
                    'iyzico_secret_key'      => 'Iyzico Secret',
                    'iyzico_sandbox'         => 'Sandbox (Test Mode)',
                    'iyzico_sandbox_active'  => 'Active',
                    'iyzico_sandbox_passive' => 'Passive',
                    'iyzico_sandbox_text'    => 'Select passive if you want get real paid',
                ]
            ]
        ],
        'home'         => [
            'count_card' => [
                'files'    => 'Uploaded Files',
                'users'    => 'Users',
                'messages' => 'Messages',
                'pages'    => 'Pages'
            ],
            'chart'      => [
                'monthly_uploads'     => 'Monthly Uploads',
                'latest_files'        => 'Latest Files',
                'show_all_files'      => 'Show All Files',
                'monthly_registers'   => 'Monthly User Registers',
                'latest_users'        => 'Latest Users',
                'show_all_users'      => 'Show All Users',
                'active_banned_users' => 'Active & Banned Users',
                'user_login_types'    => 'Users Login Types',
                'just_register'       => 'Just Register.',
                'uploaded_file'       => 'Uploaded this file:'
            ],

        ],
        'ads'          => [
            'title'       => 'Manage Ads',
            'home_left'   => 'Home Left',
            'home_right'  => 'Home Right',
            'file_left'   => 'File Left',
            'file_bottom' => 'File Bottom',
            'mobile'      => 'Mobile',
            'save_button' => 'Save Changes',
        ],
        'users'        => [
            'title'      => 'Users',
            'new_user'   => 'New User',
            'avatar'     => 'Avatar',
            'username'   => 'Username',
            'email'      => 'Email',
            'created'    => 'Created',
            'role'       => 'Role',
            'status'     => 'Status',
            'action'     => 'Action',
            'user_edit'  => 'Edit  user',
            'user_info'  => 'Info user',
            'user_ban'   => 'Ban user',
            'user_unban' => 'Unban user',
            'modal'      => [
                'title'            => 'New User',
                'username'         => 'Username',
                'email'            => 'Email Address',
                'password'         => 'Password',
                'password_confirm' => 'Confirm Password',
                'create_button'    => 'Create User',
                'close_button'     => 'Close',
                'is_admin'         => 'Is Admin User'
            ],
            'page_edit'  => [
                'title'                => 'Updating',
                'username'             => 'Username',
                'email'                => 'Email Address',
                'storage_limit'        => 'Storage Limit',
                'admin_user'           => 'Admin User',
                'premium_user'         => 'Premium User',
                'update_button'        => 'Update User',
                'delete_avatar_button' => 'Delete Avatar'
            ],
            'page_info'  => [
                'title' => 'User Files',
            ],
        ],
        'file_table'   => [
            'preview'       => 'Preview',
            'name'          => 'Name',
            'original_name' => 'Original Name',
            'size'          => 'Size',
            'created'       => 'Created',
            'expire'        => 'Expire',
            'action'        => 'Action',
            'username'      => 'Username',
            'file_info'     => 'File info',
            'delete_file'   => 'Delete file'
        ],
        'transactions' => [
            'title'    => 'Transactions',
            'empty'    => 'No Transaction Found',
            'id'       => '#ID',
            'username' => 'Username',
            'name'     => 'Product Name',
            'price'    => 'Price',
            'method'   => 'Payment Method',
            'status'   => 'Status',
            'created'  => 'Created',
            'success'  => 'Success',
            'failed'   => 'Failed',
        ],
        'products'     => [
            'title'                 => 'Products',
            'name'                  => 'Name',
            'price'                 => 'Price',
            'storage_limit'         => 'Storage Limit Product',
            'premium_user_products' => 'Premium User Product',
            'yes'                   => 'Yes',
            'no'                    => 'No',
            'created'               => 'Created',
            'action'                => 'Action',
            'edit_product'          => 'Edit product',
            'delete_product'        => 'Delete product',
            'new_product_button'    => 'New Product',
            'create'                => [
                'title'  => 'New Product',
                'button' => 'Create Product'
            ],
            'edit'                  => [
                'title'  => 'Update Product',
                'button' => 'Update Product'
            ],
            'default'               => [
                'product_name'           => 'Product Name',
                'product_price'          => 'Product Price',
                'storage_limit'          => 'Storage Limit',
                'storage_limit_default'  => 'Megabyte (MB) Only. System automatically will change this value',
                'storage_limit_product'  => 'Storage Limit Product',
                'premium_user_product'   => 'Premium User Product',
                'storage_limit_settings' => [
                    'Storage limit will increase by "Storage Limit"',
                    'The user can buy this product as many times as they want',
                ],
                'premium_user_settings'  => [
                    'User can upload unlimited expire files',
                    'Ads will not show this user',
                    'User can only buy this product 1 time',
                    'Storage limit will increase by "Storage Limit" value',
                ]
            ]
        ],
        'pages'        => [
            'title'           => 'Pages',
            'page_title'      => 'Title',
            'slug'            => 'Slug',
            'type'            => 'Type',
            'created'         => 'Created',
            'action'          => 'Action',
            'edit_page'       => 'Edit page',
            'delete_page'     => 'Delete page',
            'new_page_button' => 'New Page',
            'create'          => [
                'title'  => 'New Page',
                'button' => 'Create Page'
            ],
            'edit'            => [
                'title'  => 'Update Page',
                'button' => 'Update Page'
            ],
            'default'         => [
                'page_title'   => 'Page Title',
                'page_slug'    => 'Page Slug',
                'page_content' => 'Page Content',
                'page_default' => 'Default',
                'page_contact' => 'Contact Page',
                'page_terms'   => 'Terms Page',
                'page_privacy' => 'Privacy Page'
            ]
        ],
        'messages'     => [
            'title'          => 'Messages',
            'avatar'         => 'Avatar',
            'name'           => 'Name',
            'email'          => 'Email',
            'created'        => 'Created',
            'action'         => 'Action',
            'info_message'   => 'Info message',
            'delete_message' => 'Delete message',
        ],

        'files'            => [
            'title'     => 'Files',
            'show_page' => [
                'protecting'           => 'This file protecting with password',
                'to_file'              => 'File Page',
                'original_name'        => 'Original Name',
                'file_id'              => 'File ID',
                'size'                 => 'Size',
                'created_ago'          => 'Created Ago',
                'created_date'         => 'Created Date',
                'expire_date'          => 'Expire Date',
                'uploaded_to'          => 'Uploaded To',
                'mime_type'            => 'Mime Type',
                'download_file_button' => 'Download File'
            ]
        ],

        /* Layouts */
        'sidebar'          => [
            'main_menu'    => 'Main Menu',
            'dashboard'    => 'Dashboard',
            'users'        => 'Users',
            'files'        => 'Files',
            'products'     => 'Products',
            'transactions' => 'Transactions',
            'pages'        => 'Pages',
            'messages'     => 'Messages',
            'manage_ads'   => 'Manage Ads',
            'website'      => 'Website',
            'settings'     => 'Settings',
            'language'     => 'Language',
        ],
        'user_sidebar'     => [
            'my_profile' => 'My Profile',
            'settings'   => 'Settings',
            'website'    => 'Website',
            'logout'     => 'Logout'
        ],


        /* General */
        'no_record'        => 'No Records Found',
        'months'           => 'Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec',
        'banned'           => 'Banned',
        'active'           => 'Active',
        'user_admin_role'  => 'Admin',
        'user_normal_role' => 'User',
        'search_text'      => 'Search',
        'banned_text'      => 'has been banned',
        'user_not_found'   => 'User not found',

        /* Javascript */
        'js'               => [
            'pay'                    => 'Pay',
            'confirm_text'           => 'Are you sure?',
            'confirm_delete_button'  => 'Yes,Delete',
            'copied'                 => 'Text Copied!',
            'close'                  => 'Close',
            'file_delete'            => 'This file will be deleted',
            'avatar_delete'          => 'Your avatar will be deleted',
            'files'                  => 'Files',
            'usage'                  => 'Usage',
            'empty'                  => 'Empty',
            'used'                   => 'Used',
            'password_confirm'       => 'Your password will appear clearly. Do you confirm?',
            'password_confirm_final' => 'Your file\'s password',
            'enter_password'         => 'Enter Password',
            'password_error'         => 'Please enter file\'s password',
            'download_file'          => 'Download File',
            'dropzone'               => [
                'info'                => 'Please fill the settings for this files',
                'never'               => 'Never',
                '30'                  => '30 Days',
                '15'                  => '15 Days',
                '7'                   => '7 Days',
                '1'                   => '1 Days',
                'confirm_button_text' => 'Upload Files',
                'recaptcha_error'     => 'Please verify that you\'re not a robot',
                'close'               => 'Close',
                'password'            => 'Password for files',
            ],
            /* Admin */
            'admin'                  => [
                'active'         => 'Active',
                'banned'         => 'Banned',
                'users'          => 'Users',
                'uploads'        => 'Uploads',
                'are_you_sure'   => 'Are you sure?',
                'cancel'         => 'Cancel',
                'close'          => 'Close',
                'confirm_delete' => 'Yes,Delete',
                'confirm_ban'    => 'Yes,Ban',
                'confirm_unban'  => 'Yes,Unban',

                'user_ban'         => 'This user will be banned',
                'user_unban'       => 'This user will be unbanned',
                'new_user_success' => 'New User Added',
                'page_delete'      => 'This page will be deleted',
                'product_delete'   => 'This product will be deleted',
                'message_delete'   => 'This message will be deleted',
                'file_delete'      => 'This file will be deleted',
                'avatar_delete'    => 'User avatar will be deleted',
            ],
        ],
    ],
    'here'                    => 'here',
    'password_does_not_match' => 'Current password does not match',
    'currency'                => '$',
];
