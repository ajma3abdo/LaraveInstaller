<?php

namespace Ajamaa\LaravelInstaller\Controllers;

use Ajamaa\LaravelInstaller\Helpers\Database;
use Ajamaa\LaravelInstaller\Helpers\LicenceKey;
use Ajamaa\LaravelInstaller\Helpers\Permissions;
use Ajamaa\LaravelInstaller\Helpers\Requirements;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class HomeController
{
    public function index()
    {
        return view('vendor.ajamaa.laravel-installer.index');
    }

    public function licence(Request $request)
    {
        if (!config('installer.licence.enable')) {
            abort(404);
        }

        if (LicenceKey::check()) {
            return to_route('install::permissions');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'key' => 'required'
            ], [], ['key' => "مفتاح الترخيص"]);

            $url = config('installer.licence.url_check');
            $key = $request->key;
            $domain = parse_url(URL::full(), PHP_URL_HOST);

            $response = Http::post("$url/check/$domain/$key");

            $data = $response->json();

            if (is_array($data)) {
                if (isset($data['status'])) {
                    if ($data['status']) {
                        try {
                            $file = fopen(storage_path("licence"), "a+");
                            fwrite($file, $key);
                            fclose($file);
                        } catch (\Exception $e) {
                            //dd($e->getMessage());
                        }

                        return to_route('install::permissions');
                    } else {
                        return to_route('install::licence')->with('error', $data['message']);
                    }
                }
            }

            return to_route('install::licence')->with('error', "Error");
        }

        return view('vendor.ajamaa.laravel-installer.licence');
    }

    public function permissions()
    {

        if (!LicenceKey::check()) {
            return to_route('install::licence')->with('error', __('laravel_installer.errors.licence_missing'));
        }

        $error =  false;
        $permissions = [];

        foreach (config('installer.permissions') as $folder => $permission) {
            $current_permission = substr(sprintf('%o', fileperms(base_path($folder))), -4);
            if (!($current_permission >= $permission)) {

                array_push($permissions, [
                    'folder' => $folder,
                    'permission' => $permission,
                    'current_permission' => $current_permission,
                    'isSet' => false,
                ]);

                $error = true;
            } else {

                array_push($permissions, [
                    'folder' => $folder,
                    'permission' => $permission,
                    'current_permission' => $current_permission,
                    'isSet' => true,
                ]);
            }
        }

        return view('vendor.ajamaa.laravel-installer.permissions', compact('error', 'permissions'));
    }

    public function requirements()
    {
        if (!LicenceKey::check()) {
            return to_route('install::licence')->with('error', __('laravel_installer.errors.licence_missing'));
        }

        if (!Permissions::check()) {
            return to_route('install::permissions')->with('error', __('laravel_installer.errors.permissions'));
        }

        $error =  false;
        $requirements = [];
        $reqs = config('installer.requirements');

        foreach ($reqs as $type => $requirement) {
            switch ($type) {
                    // check php requirements
                case 'php':
                    foreach ($reqs[$type] as $requirement) {
                        $requirements[$type][$requirement] = true;

                        if (!extension_loaded($requirement)) {
                            $requirements[$type][$requirement] = false;

                            $error = true;
                        }
                    }
                    break;
                    // check apache requirements
                case 'apache':
                    foreach ($reqs[$type] as $requirement) {
                        // if function doesn't exist we can't check apache modules
                        if (function_exists('apache_get_modules')) {
                            $requirements[$type][$requirement] = true;

                            if (!in_array($requirement, apache_get_modules())) {
                                $requirements[$type][$requirement] = false;

                                $error = true;
                            }
                        }
                    }
                    break;
            }
        }

        $minVersionPhp = config('installer.core.minPhpVersion');
        $currentPhpVersion = null;

        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        $currentPhpVersion =  [
            'full' => $currentVersionFull,
            'version' => $currentVersion,
        ];
        $supported = false;

        if (version_compare($currentPhpVersion['version'], $minVersionPhp) >= 0) {
            $supported = true;
        }

        $phpStatus = [
            'full' => $currentPhpVersion['full'],
            'current' => $currentPhpVersion['version'],
            'minimum' => $minVersionPhp,
            'supported' => $supported,
        ];

        return view('vendor.ajamaa.laravel-installer.requirements', compact('error', 'requirements', 'phpStatus'));
    }

    public function environment(Request $request)
    {
        if (!LicenceKey::check()) {
            return to_route('install::licence')->with('error', __('laravel_installer.errors.licence_missing'));
        }

        if (!Permissions::check()) {
            return to_route('install::permissions')->with('error', __('laravel_installer.errors.permissions'));
        }

        if (!Requirements::check()) {
            return to_route('install::requirements')->with('error', __('laravel_installer.errors.requirements'));
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'content' => 'required'
            ]);

            try {
                file_put_contents(base_path('.env'), $request->content);

                return to_route('install::database');
            } catch (\Exception $e) {
                return to_route('install::environment')->with('error', $e->getMessage());
            }
        }

        $file = file_get_contents(base_path('.env'));

        return view('vendor.ajamaa.laravel-installer.environment', compact('file'));
    }

    public function database()
    {
        if (!LicenceKey::check()) {
            return to_route('install::licence')->with('error', __('laravel_installer.errors.licence_missing'));
        }

        if (!Permissions::check()) {
            return to_route('install::permissions')->with('error', __('laravel_installer.errors.permissions'));
        }

        if (!Requirements::check()) {
            return to_route('install::requirements')->with('error', __('laravel_installer.errors.requirements'));
        }

        try {
            DB::getPdo();

            Artisan::call('migrate:fresh', [
                '--seed' => true,
                '--force' => true
            ]);
        } catch (\Exception $e) {
            return to_route('install::environment')->with('error', $e->getMessage());
        }

        session()->flash("success", "تم تنصيب قاعدة البيانات بنجاح");

        return view('vendor.ajamaa.laravel-installer.database');
    }

    public function admin(Request $request)
    {

        if (!config('installer.admin.enable')) {
            return to_route('install::final');
        }

        if (!LicenceKey::check()) {
            return to_route('install::licence')->with('error', __('laravel_installer.errors.licence_missing'));
        }

        if (!Permissions::check()) {
            return to_route('install::permissions')->with('error', __('laravel_installer.errors.permissions'));
        }

        if (!Requirements::check()) {
            return to_route('install::requirements')->with('error', __('laravel_installer.errors.requirements'));
        }

        if (!Database::check()) {
            return to_route('install::environment')->with('error', __('laravel_installer.errors.database'));
        }

        if ($request->isMethod('post')) {
            $rules = [];
            $user = [];

            foreach (config('installer.admin.form') as $name => $value) {
                $rules[$name] = $value['rules'];

                $user[$name] = $request->$name;
            }

            $request->validate($rules);

            $u = User::create($user);
            $u->AssignRole('Admin');

            Auth::login($u);

            return to_route('install::final');
        }

        return view('vendor.ajamaa.laravel-installer.admin');
    }

    public function final()
    {
        if (!LicenceKey::check()) {
            return to_route('install::licence')->with('error', __('laravel_installer.errors.licence_missing'));
        }

        if (!Permissions::check()) {
            return to_route('install::permissions')->with('error', __('laravel_installer.errors.permissions'));
        }

        if (!Requirements::check()) {
            return to_route('install::requirements')->with('error', __('laravel_installer.errors.requirements'));
        }

        if (!Database::check()) {
            return to_route('install::environment')->with('error', __('laravel_installer.errors.database'));
        }

        if (!file_exists(storage_path('installed'))) {
            try {
                $file = fopen(storage_path("installed"), "a+");

                $data = [
                    'date' => now(),
                ];

                fwrite($file, json_encode($data));

                fclose($file);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        if (config('installer.final.key')) {
            Artisan::call('key:generate');
        }


        return view('vendor.ajamaa.laravel-installer.final');
    }
}
