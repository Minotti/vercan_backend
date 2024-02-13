<?php

namespace App\Modules\Location\Services;

use App\Modules\Core\Services\Service;
use App\Modules\Location\Repositories\CityRepository;

class CityService extends Service
{
    public function repository(): string
    {
        return CityRepository::class;
    }
}
