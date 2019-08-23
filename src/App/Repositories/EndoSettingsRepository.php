<?php


namespace Endo\EndoCore\App\Repositories;


use Endo\EndoCore\App\Models\EndoSetting;

class EndoSettingsRepository
{

    public function get($key)
    {
        return EndoSetting::where('key', $key)->first();
    }


    public function set(array $params)
    {
        $key = $params['key'];
        unset($params['key']);

        return EndoSetting::updateOrCreate(['key' => $key], $params);
    }
}