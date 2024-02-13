<?php

namespace App\Modules\Core\Traits;

use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Collection;

trait TenantMigrationTrait
{
    /**
     * Get all companies
     *
     * @return Collection
     */
    public function companies(): Collection
    {
        return Company::all();
    }
}
