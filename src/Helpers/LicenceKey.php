<?php

namespace Ajamaa\LaravelInstaller\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class LicenceKey
{
    /**
     * Returns true when licence is disabled OR the licence file already exists
     * (meaning it was verified remotely at the time the user submitted the key).
     * We do not re-hit the remote server on every page to avoid slow/fragile pages.
     */
    public static function check(): bool
    {
        if (!config('installer.licence.enable')) {
            return true;
        }

        return file_exists(storage_path('licence'));
    }

    /**
     * Called only once, during the POST on the licence page.
     * Returns ['status' => bool, 'message' => string].
     */
    public static function verify(string $key): array
    {
        $url    = config('installer.licence.url_check');
        $domain = parse_url(\Illuminate\Support\Facades\URL::full(), PHP_URL_HOST);

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(10)
                ->post("$url/check/$domain/$key");

            $data = $response->json();

            if (is_array($data) && isset($data['status'])) {
                return [
                    'status'  => (bool) $data['status'],
                    'message' => $data['message'] ?? 'خطأ غير معروف',
                ];
            }
        } catch (\Exception $e) {
            return ['status' => false, 'message' => 'تعذّر الاتصال بخادم التراخيص'];
        }

        return ['status' => false, 'message' => 'استجابة غير صالحة من خادم التراخيص'];
    }
}
