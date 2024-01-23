# Laravel Installer Package


This package is making installing your laravel app in the hosting much easy with some configurations.

## benefits

* Install the application
* migrate the database
* can seed any settings
* verify purchase code
  
    > Look at the config file for more informations
  

## Installation

You can install the package via composer:

```

composer require ajamaa/laravel-installer

```

## Configurations

```

php artisan vendor:publish --tag=laravelinstaller

```

add the middleware to web list middlewareGroups in Kernel.php file

```
/**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \Ajamaa\LaravelInstaller\Middlewares\LaravelInstallerMiddleware::class
            .
            .
            .
        ],
    ];

```

## Security

If you discover any security-related issues, please email abderrahim@ajamaa.me instead of using the issue tracker.

## Credits

[Abderrahim Ajamaa](https://ajamaa.me)

## License

The MIT License (MIT).
