<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RammasageResource extends JsonResource
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
            'agence'   => $this->agence,
            'quantity'     => $this->quantity,
            'price'    => $this->price,
            'colis'     => $this->colis ? $this->colis->count() : 0,
            'user'     => $this->user,
            'clients'   => $this->colis ? $this->colis->clients : 0,
            'colis'     => $this->colis,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
