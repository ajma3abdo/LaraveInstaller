<?php

namespace Ajamaa\LaravelInstaller\Helpers;


class Permissions
{
    public static function check(): bool
    {
        foreach (config('installer.permissions') as $folder => $permission) {
            $path = base_path($folder);

            if (!file_exists($path)) {
                return false;
            }

            $current = octdec(substr(sprintf('%o', fileperms($path)), -4));
            $required = octdec($permission);

            if ($current < $required) {
                return false;
            }
        }

        return true;
    }
}
