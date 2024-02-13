<?php

namespace App\Modules\Location\Repositories;

use App\Modules\Core\Repositories\Repository;
use App\Modules\Location\Models\State;

class StateRepository extends Repository
{
    public function model(): string
    {
        return State::class;
    }
}
