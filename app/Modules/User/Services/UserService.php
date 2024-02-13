<?php

namespace App\Modules\User\Services;

use App\Modules\Core\Services\Service;
use App\Modules\User\Repositories\UserRepository;

class UserService extends Service
{
    public function repository(): string
    {
        return UserRepository::class;
    }

    /**
     * Revoke all user tokens
     * @return void
     */
    public function revokeTokens(): void
    {
        auth()->user()->tokens()->delete();
    }
}
