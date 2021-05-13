<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class LivreurResource extends JsonResource
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
            "id"                => $this->id,
            "name"              => $this->name,
            "status"            => $this->status,
            "phone"             => $this->phone,
            "city"              => $this->city,
            "colis"             => $this->colis,
            "colis_count"       => $this->colis ? $this->colis->count() : 0,
            "colis_encore"           => $this->colis_encore(),
            "payed"           => $this->payed(),
            "total"           => $this->total(),
            "totalNet"           => $this->totalNet(),
            "colis_return"           => $this->colis_return(),
            "colis_livre"             => $this->colis_livre(),
            "created_at"        => $this->created_at->format('Y-m-d H:m:s'),
        ];
    }
}
