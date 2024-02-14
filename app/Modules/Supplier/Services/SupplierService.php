<?php

namespace App\Modules\Supplier\Services;

use App\Modules\Supplier\Repositories\SupplierRepository;
use App\Modules\Core\Services\Service;
use Illuminate\Database\Eloquent\Model;

class SupplierService extends Service
{
    public function repository(): string
    {
        return SupplierRepository::class;
    }

    /**
     * Returns all suppliers with contacts and address
     *
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function list(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->repository->model->with(['contacts', 'address.city'])->get();
    }

    public function create(array $attributes): mixed
    {
        $supplier = $this->repository->create($attributes);

        //Store contacts and address
        $this->storeContacts($supplier, $attributes['contacts']);
        $this->storeAddress($supplier, $attributes['address']);

        return $supplier;
    }

    public function update(int $modelId, array $attributes): ?\Illuminate\Database\Eloquent\Model
    {
        $supplier = $this->find($modelId);

        $this->repository->update($modelId, $attributes);

        //Update contacts and address
        $this->storeContacts($supplier, $attributes['contacts']);
        $this->storeAddress($supplier, $attributes['address']);

        return $supplier->refresh();
    }

    /**
     * This remove all contacts from supplier and create again
     *
     * @param Model $supplier
     * @param array $contacts
     * @return void
     */
    private function storeContacts(Model $supplier, array $contacts): void
    {
        $supplier->contacts()->delete();
        $supplier->contacts()->createMany($contacts);
    }

    /**
     * This remove the address from supplier and create again
     *
     * @param Model $supplier
     * @param array $address
     * @return void
     */
    private function storeAddress(Model $supplier, array $address): void
    {
        $supplier->address()->delete();
        $supplier->address()->create($address);
    }
}
