<?php


namespace Endo\EndoCore\App\Services;


use Endo\EndoCore\App\Repositories\EndoSettingsRepository;

class EndoSettingsService
{

    /**
     * @var EndoSettingsRepository
     */
    private $endoSettingsRepository;


    public function __construct(EndoSettingsRepository $endoSettingsRepository)
    {
        $this->endoSettingsRepository = $endoSettingsRepository;
    }


    public function get($key, $default = null)
    {
        $setting = $this->endoSettingsRepository->get($key);

        return $setting ? $setting->value : $default;
    }


    public function set(array $params, $description = null)
    {
        if (count($params) != 1) {
            abort(500);
        }

        $params = [
            'key' => key($params),
            'value' => $params[key($params)],
            'description' => $description ?: ''
        ];

        return $this->endoSettingsRepository->set($params);
    }
}