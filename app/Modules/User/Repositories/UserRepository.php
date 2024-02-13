<?php

namespace App\Modules\User\Repositories;

use App\Modules\Core\Repositories\Repository;
use App\Modules\User\Models\User;

class UserRepository extends Repository
{
    /**
     * Setting the model
     */
    public function model(): string
    {
        return User::class;
    }
}


