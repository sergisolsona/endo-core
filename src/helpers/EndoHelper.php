<?php

if (! function_exists('endo_setting')) {
    /**
     * @param string|array $key
     * @param null $default
     *
     * @return bool|string|null
     */
    function endo_setting($key, $default = null)
    {
        $endoSettings = app(\Endo\EndoCore\App\Services\EndoSettingsService::class);

        if (is_array($key)) {
            return $endoSettings->set($key, $default);
        }

        return $endoSettings->get($key, $default);
    }
}