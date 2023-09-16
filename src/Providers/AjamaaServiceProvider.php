<?php

namespace Ajamaa\LaravelInstaller\Providers;

use Illuminate\Support\ServiceProvider;

class AjamaaServiceProvider extends ServiceProvider
{


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->publishFiles();
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../Config/installer.php' => base_path('config/installer.php'),
        ], 'laravelinstaller');

        $this->publishes([
            __DIR__ . '/../Assets' => public_path(),
        ], 'laravelinstaller');

        $this->publishes([
            __DIR__ . '/../Views' => base_path('resources/views/vendor/ajamaa/laravel-installer'),
        ], 'laravelinstaller');

        $this->publishes([
            __DIR__ . '/../Lang' => base_path('lang'),
        ], 'laravelinstaller');
    }
}
