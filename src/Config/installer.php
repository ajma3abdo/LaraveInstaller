<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '7.0.0',
    ],
    'final' => [
        'key' => true,
        'redirect_after_installation_url' => "/admin/settings",
    ],
    'requirements' => [
        'php' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Licence Checker
    |--------------------------------------------------------------------------
    |
    */

    'licence' => [
        'enable' => true,
        'url_check' => "https://keysmanager.test",
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/framework/'     => '775',
        'storage/logs/'          => '775',
        'bootstrap/cache/'       => '775',
    ],

    /*
    |--------------------------------------------------------------------------
    | Manager
    |--------------------------------------------------------------------------
    |
    */
    'admin' => [
        'enable' => true,
        'form' => [
            'name' => [
                'type' => "text",
                'rules' => "required|max:200|string"
            ],
            'email' => [
                'type' => "email",
                'rules' => "required|max:200|email"
            ],
            'password' => [
                'type' => "password",
                'rules' => "required|max:200"
            ],
        ]
    ],

    'logo_url' => "/storage/images/naqi-logo-white.png",

    'default_language' => "ar"

];
