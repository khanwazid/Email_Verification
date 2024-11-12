<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'profile_photo_url' => $this->profile_photo_url,
            'image' => $this->image,
            'username' => $this->username,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'role' => $this->role,
            'addresses' => AddressResource::collection($this->whenLoaded('addresses')), // Load addresses if available
        ];
    }
}