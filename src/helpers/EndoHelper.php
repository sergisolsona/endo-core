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

if (! function_exists('active_color')) {
    function active_color($hex)
    {
        $newHex = adjust_brightness($hex, -32);

        if ($newHex == $hex || $newHex == '#000000') {
            $newHex = adjust_brightness($hex, 32);
        }

        return $newHex;
    }
}


if (! function_exists('adjust_brightness')) {
    function adjust_brightness($hex, $steps)
    {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
        }

        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';

        foreach ($color_parts as $color) {
            $color = hexdec($color); // Convert to decimal
            $color = max(0, min(255, $color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }

        return $return;
    }
}