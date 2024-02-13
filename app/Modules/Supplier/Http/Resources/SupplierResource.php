<?php

namespace App\Modules\Supplier\Http\Resources;

use App\Modules\Core\Http\Resources\AddressResource;
use App\Modules\Core\Http\Resources\BaseResource;

class SupplierResource extends BaseResource
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
            'legal_name' => $this->legal_name ?? $this->name,
            'trade_name' => $this->trade_name ?? $this->nickname,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'type' => $this->type,
            'cpf_cnpj' => $this->cpf_cnpj,
            'rg' => $this->rg,
            'active' => (bool) $this->active,
            'ie_indicator' => $this->ie_indicator,
            'ie' => $this->ie,
            'im' => $this->im,
            'gathering' => $this->gathering,
            'observation' => $this->observation,
            'contacts' => SupplierContactsResource::collection($this->contacts),
            'asdasd' => $this->address,
            'address' => new AddressResource($this->address)
        ];
    }
}
