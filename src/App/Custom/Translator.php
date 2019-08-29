<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 29/08/2019
 * Time: 18:07
 */

namespace Endo\EndoCore\App\Custom;


class Translator extends \Illuminate\Translation\Translator
{

    /**
     * Get the translation for a given key from the JSON translation files.
     *
     * @param string $key
     * @param array $replace
     * @param null $locale
     * @return string|array|null
     */
    public function getFromJson($key, array $replace = [], $locale = null)
    {
        $mLocale = $locale ?: $this->locale;
        if (app()->environment() == 'endotest' && !parent::has($key, $locale)) {
            $filename = __DIR__ . "/../../resources/lang/$mLocale.json";

            $trans = json_decode(file_get_contents($filename), true);

            $trans[$key] = $key;
            ksort($trans);

            file_put_contents($filename, json_encode($trans, JSON_PRETTY_PRINT));
        }

        return parent::getFromJson($key, $replace, $locale);
    }
}