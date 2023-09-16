<?php

namespace Ajamaa\LaravelInstaller\Helpers;


class Permissions
{
    public static function check()
    {
        foreach (config('installer.permissions') as $folder => $permission) {
            $current_permission = substr(sprintf('%o', fileperms(base_path($folder))), -4);
            if (!($current_permission >= $permission)) {
                return false;
            }
        }

        return true;
    }
}
