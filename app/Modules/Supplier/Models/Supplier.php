<?php

namespace App\Modules\Supplier\Models;

use App\Modules\Core\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Supplier\Factories\SupplierFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'legal_name',
        'trade_name',
        'name',
        'nickname',
        'type',
        'cpf_cnpj',
        'rg',
        'active',
        'ie_indicator',
        'ie',
        'im',
        'gathering',
        'observation',
    ];

    protected static function newFactory(): Factory
    {
        return SupplierFactory::new();
    }

    public function contacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SupplierContacts::class);
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
