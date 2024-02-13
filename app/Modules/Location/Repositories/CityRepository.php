<?php

namespace App\Modules\Location\Repositories;

use App\Modules\Core\Repositories\Repository;
use App\Modules\Location\Models\City;

class CityRepository extends Repository
{
    public function model(): string
    {
        return City::class;
    }
}
