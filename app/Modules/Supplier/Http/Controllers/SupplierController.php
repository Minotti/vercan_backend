<?php

namespace App\Modules\Supplier\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Supplier\Http\Requests\SupplierRequest;
use App\Modules\Supplier\Http\Resources\SupplierResource;
use App\Modules\Supplier\Services\SupplierService;

class SupplierController extends Controller
{
    public function __construct(protected SupplierService $service)
    {
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->okResponse(SupplierResource::collection($this->service->all()));
    }

    public function store(SupplierRequest $request): \Illuminate\Http\JsonResponse
    {
        $supplier = $this->service->create($request->validated());
        return $this->createdResponse(new SupplierResource($supplier));
    }

    public function show($supplierId): \Illuminate\Http\JsonResponse
    {
        return $this->okResponse(new SupplierResource($this->service->find($supplierId)));
    }

    public function update($supplierId, SupplierRequest $request): \Illuminate\Http\JsonResponse
    {
        $supplier = $this->service->update($supplierId, $request->validated());
        return $this->okResponse(new SupplierResource($supplier));
    }

    public function destroy($supplierId): \Illuminate\Http\JsonResponse
    {
        $this->service->delete($supplierId);
        return $this->okResponse([], 'Supplier deleted successfully');
    }
}
