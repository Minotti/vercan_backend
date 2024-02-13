<?php

namespace App\Modules\Core\Models;

use App\Modules\Location\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'postcode',
        'address',
        'district',
        'number',
        'info',
        'complement',
        'condominium',
    ];

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
