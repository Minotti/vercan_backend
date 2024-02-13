<?php

namespace App\Modules\Supplier\Enums;

enum SupplierContactEmailEnum: String
{
    case Personal = 'personal';
    case Commercial = 'commercial';
    case Other = 'other';
}
