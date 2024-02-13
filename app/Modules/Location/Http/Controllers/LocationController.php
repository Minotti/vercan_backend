<?php

namespace App\Modules\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Http\Resources\CityResource;
use App\Modules\Core\Http\Resources\StateResource;
use App\Modules\Core\Traits\HttpResponseTrait;
use App\Modules\Location\Services\CityService;
use App\Modules\Location\Services\StateService;

class LocationController extends Controller
{
    use HttpResponseTrait;

    public function __construct(protected CityService $cityService, protected StateService $stateService)
    {
    }

    public function states(): \Illuminate\Http\JsonResponse
    {
        return $this->okResponse(StateResource::collection($this->stateService->all()));
    }

    public function citiesByUf($uf): \Illuminate\Http\JsonResponse
    {
        $state = $this->stateService->findByUf($uf);
        return $this->okResponse(CityResource::collection($state->cities));
    }
}
