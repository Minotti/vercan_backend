<?php

namespace App\Modules\Core\Repositories;

use App\Modules\Core\Exceptions\EntityNotDefined;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * @var Model
     */
    public Model $model;

    abstract public function model();

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    /**
     * Create an item
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Update an item
     *
     * @param int $modelId
     * @param array $attributes
     *
     * @return Model
     */
    public function update(int $modelId, array $attributes): Model
    {
        return tap($this->find($modelId))->update($attributes);
    }

    /**
     * Find an item by given id
     *
     * @param int $modelId
     * @return Model|null
     */
    public function find(int $modelId): ?Model
    {
        return $this->model->findOrFail($modelId);
    }

    /**
     * Delete an item
     *
     * @param int $modelId
     */
    public function delete(int $modelId): void
    {
        $this->find($modelId)->delete();
    }


    /**
     * Return all items
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }

    /**
     * Paginate the results with the given number per page.
     *
     * @param int $perPage
     * @return mixed
     */
    public function paginate(int $perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Resolve the model
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
     * @throws EntityNotDefined
     */
    public function resolveModel()
    {
        if (!method_exists($this, 'model')) {
            throw new EntityNotDefined();
        }

        return app($this->model());
    }
}
