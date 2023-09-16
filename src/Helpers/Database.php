<?php

namespace Ajamaa\LaravelInstaller\Helpers;

use Illuminate\Support\Facades\DB;

class Database
{
    public static function check()
    {
        try {
            DB::getPdo();

            return true;
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }
}
