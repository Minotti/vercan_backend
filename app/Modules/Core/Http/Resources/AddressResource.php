<?php

namespace App\Modules\Core\Http\Resources;

class AddressResource extends BaseResource
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
			'city_id' => $this->city_id,
            'city' => new CityResource($this->city),
			'postcode' => $this->postcode,
			'address' => $this->address,
			'district' => $this->district,
			'number' => $this->number,
			'info' => $this->info,
			'complement' => $this->complement,
			'condominium' => $this->condominium
        ];
    }
}
