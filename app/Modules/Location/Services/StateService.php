<?php

namespace App\Modules\Location\Services;

use App\Modules\Core\Services\Service;
use App\Modules\Location\Repositories\StateRepository;
use Illuminate\Database\Eloquent\Model;

class StateService extends Service
{
    public function repository(): string
    {
        return StateRepository::class;
    }

    public function findByUf(string $uf): ?Model
    {
        return $this->repository->model->byUf($uf)->with('cities')->firstOrFail();
    }
}
