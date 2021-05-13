<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'adresse'   => $this->adresse,
            'phone'     => $this->phone,
            'email'     => $this->email,
            'status'    => $this->status,
            'city'      => $this->city,
            'colis'     => $this->colis ? $this->colis->count() : 0,
            'users'     => $this->users ? $this->users->count() : 0,
            'clients'   => $this->clients ? $this->clients->count() : 0,
            'colis'     => $this->colis ? $this->colis->count() : 0,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
