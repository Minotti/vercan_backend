<?php

namespace App\Modules\Supplier\Repositories;

use App\Modules\Core\Repositories\Repository;
use App\Modules\Supplier\Models\Supplier;

class SupplierRepository extends Repository
{
    public function model(): string
    {
        return Supplier::class;
    }
}
