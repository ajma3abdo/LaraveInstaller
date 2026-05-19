<?php

namespace Ajamaa\LaravelInstaller\Middlewares;

use Closure;

class LaravelInstallerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $isInstallRoute = $request->is('install') || $request->is('install/*');

        // Set locale for all installer pages
        if ($isInstallRoute) {
            app()->setLocale(config('installer.default_language'));
        }

        if (!$this->isInstalled()) {
            // Redirect non-install routes to the installer
            if (!$isInstallRoute) {
                return redirect()->route('install::index');
            }
        } else {
            // Once installed, block access to the installer
            if ($isInstallRoute) {
                abort(404);
            }
            app()->setLocale(config('installer.default_language'));
        }

        return $next($request);
    }

    private function isInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}
