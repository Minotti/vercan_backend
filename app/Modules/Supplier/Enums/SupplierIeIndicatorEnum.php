<?php

namespace App\Modules\Supplier\Enums;

enum SupplierIeIndicatorEnum: String
{
    case Contribuinte = 'contribuinte';
    case ContribuinteIsento = 'contribuinte_isento';
    case NaoContribuinte = 'nao_contribuinte';
}
