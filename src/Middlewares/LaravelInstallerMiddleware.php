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
        app()->setLocale(config('installer.default_language'));
        if (!$this->isInstalled()) {

            if ("install" != $request->route()->getPrefix()) {
                return redirect()->route("install::index");
            }
        } else {
            if ("install" == $request->route()->getPrefix()) {
                abort(404);
            }
        }

        return $next($request);
    }

    private function isInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}
