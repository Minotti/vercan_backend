<?php

namespace App\Modules\Supplier\Http\Resources;

use App\Modules\Core\Http\Resources\BaseResource;

class SupplierContactsResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'additional' => $this->resource->additional,
            'business' => $this->business,
            'office' => $this->office,
            'contacts' => $this->contacts
        ];
    }
}
