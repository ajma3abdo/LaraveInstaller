<?php

return [
    'title'       => "Installation Wizard",
    'welcome'     => "Welcome to the Installation",
    'welcome_desc'=> "This wizard will guide you through the application installation process step by step, safely and easily.",
    'start'       => "Start Installation",

    'steps' => [
        'welcome'      => 'Welcome',
        'licence'      => 'Licence Key',
        'permissions'  => 'Folder Permissions',
        'requirements' => 'Requirements',
        'environment'  => 'Configuration File',
        'database'     => 'Database',
        'admin'        => 'Admin Account',
        'final'        => 'Installation Complete',
        'step'         => 'Step',
    ],

    'back' => 'Back',

    'licence' => [
        'title' => 'Licence Key',
        'next'  => 'Verify Licence',
        'form'  => [
            'label' => 'Licence Key',
        ],
    ],

    'permissions' => [
        'title'     => "Folder Permissions",
        'next'      => 'Next Step',
        'error'     => "Please fix the errors before proceeding to the next step",
        'required'  => "Required Permission",
        'current'   => "Current Permission",
        'not_found' => "Not Found",
        'enabled'   => "OK",
        'failed'    => "Failed",
    ],

    'requirements' => [
        'title'         => "Requirements",
        'next'          => 'Next Step',
        'error'         => "Please fix the errors before proceeding to the next step",
        'php_version'   => "PHP Version",
        'supported'     => "Supported",
        'not_supported' => "Not Supported",
        'enabled'       => "Enabled",
        'not_enabled'   => "Not Enabled",
    ],

    'environment' => [
        'title' => ".env File",
        'label' => ".env File Contents",
        'next'  => 'Next Step',
        'save'  => 'Save',
    ],

    'database' => [
        'title'        => "Database",
        'next'         => 'Next Step',
        'success_body' => "Tables have been migrated and seeded successfully.",
        'loading'      => "Proceeding to the next step…",
    ],

    'admin' => [
        'title' => "Create Admin Account",
        'next'  => 'Next Step',
        'save'  => 'Confirm',
        'form'  => [
            'name'     => "Full Name",
            'email'    => "Email Address",
            'password' => "Password",
        ],
    ],

    'final' => [
        'title'     => "Installation Complete",
        'desc'      => "The application has been installed successfully",
        'home_page' => "Go to Homepage",
    ],

    'validation' => [
        'required' => 'The :attribute field is required.',
        'max'      => 'The :attribute may not be greater than :max characters.',
        'min'      => 'The :attribute must be at least :min characters.',
        'email'    => 'The :attribute must be a valid email address.',
        'string'   => 'The :attribute must be a string.',
    ],

    'errors' => [
        'licence_missing' => "Please activate the script before any other step",
        'permissions'     => "Please check folder permissions before any other step",
        'requirements'    => 'Please check requirements before any other step',
        'database'        => 'Please check your database connection details',
    ],
];
