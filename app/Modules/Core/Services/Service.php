<?php

namespace App\Modules\Core\Services;

use App\Modules\Core\Exceptions\RepositoryNotFound;
use App\Modules\Core\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    protected Repository $repository;

    abstract public function repository();

    /**
     * @throws RepositoryNotFound
     */
    public function __construct()
    {
        $this->repository = $this->resolveRepository();
    }

    /**
     * Create a register on database
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        return $this->repository->create($attributes);
    }

    /**
     * Update a register on database
     *
     * @param int $modelId
     * @param array $attributes
     *
     * @return Model|null
     */
    public function update(int $modelId, array $attributes): null|Model
    {
        return $this->repository->update($modelId, $attributes);
    }

    /**
     * Find a register on database
     *
     * @param int $modelId
     * @return Model|null
     */
    public function find(int $modelId): ?Model
    {
        return $this->repository->find($modelId);
    }

    /**
     * Delete a register
     *
     * @param int $modelId
     */
    public function delete(int $modelId): void
    {
        $this->repository->delete($modelId);
    }

    /**
     * Return all registers
     *
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all(): array|\Illuminate\Database\Eloquent\Collection
    {
        return $this->repository->all();
    }

    /**
     * Returns a paginated list
     *
     * @param int $perPage
     * @return mixed
     */
    public function paginate(int $perPage = 15): mixed
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Returns an instance of Repository
     * @throws RepositoryNotFound
     */
    public function resolveRepository(): Repository
    {
        if (!method_exists($this, 'repository')) {
            throw new RepositoryNotFound();
        }

        return app($this->repository());
    }
}
