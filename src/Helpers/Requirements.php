<?php

namespace Ajamaa\LaravelInstaller\Helpers;


class Requirements
{
    public static function check()
    {
        $reqs = config('installer.requirements');

        foreach ($reqs as $type => $requirement) {
            switch ($type) {
                    // check php requirements
                case 'php':
                    foreach ($reqs[$type] as $requirement) {
                        $requirements[$type][$requirement] = true;

                        if (!extension_loaded($requirement)) {
                            $requirements[$type][$requirement] = false;

                            return false;
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

                                return false;
                            }
                        }
                    }
                    break;
            }
        }

        $minVersionPhp = config('installer.core.minPhpVersion');

        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        if (!(version_compare($currentVersion, $minVersionPhp) >= 0)) {
            return false;
        }

        return true;
    }
}
