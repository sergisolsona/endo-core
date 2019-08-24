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


if (! function_exists('route_name')) {
    /**
     * @param null $as
     *
     * @return bool|string|null
     */
    function route_name($as = null)
    {
        if (!request()->route()) {
            return null;
        }

        $route = request()->route()->getAction();
        if (array_key_exists('as', $route)) {
            return $as ? $as == $route['as'] : $route['as'];
        }
    }
}