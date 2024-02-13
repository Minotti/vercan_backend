<?php

namespace App\Modules\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'additional',
        'name',
        'company',
        'office',
        'contacts',
    ];

    protected $casts = [
        'contacts' => 'array'
    ];
}
