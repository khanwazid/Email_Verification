<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => [
                'id' => $this->city->id,
                'name' => $this->city->name,
                'state' => [
                    'id' => $this->city->state->id,
                    'name' => $this->city->state->name,
                    'country' => [
                        'id' => $this->city->state->country->id,
                        'name' => $this->city->state->country->name,
                    ]
                ]
            ],
        ];
    }
}
