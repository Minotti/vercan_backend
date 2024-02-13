<?php

namespace App\Modules\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
//    public static $wrap = 'data';

    public function jsonOptions () {
        return JSON_UNESCAPED_SLASHES;
    }
}
