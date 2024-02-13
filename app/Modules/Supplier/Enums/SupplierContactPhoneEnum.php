<?php

namespace App\Modules\Supplier\Enums;

enum SupplierContactPhoneEnum: String
{
    case Residential = 'residential';
    case Commercial = 'commercial';
    case Cellphone = 'cellphone';
}
