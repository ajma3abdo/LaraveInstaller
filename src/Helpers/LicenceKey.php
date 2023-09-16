<?php

namespace Ajamaa\LaravelInstaller\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class LicenceKey
{
    public static function check()
    {
        if (!config('installer.licence.enable')) {
            return true;
        }

        if (!file_exists(storage_path('licence'))) {
            return false;
        }

        $url = config('installer.licence.url_check');
        $key = file_get_contents(storage_path('licence'));
        $domain = parse_url(URL::full(), PHP_URL_HOST);

        $response = Http::post("$url/check/$domain/$key");

        $data = $response->json();

        if (is_array($data)) {
            if (isset($data['status'])) {
                if ($data['status']) {
                    return true;
                }
            }
        }

        return false;
    }
}
