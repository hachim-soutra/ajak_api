<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'email'     => $this->email,
            'colis'     => $this->colis ? $this->colis->count() : 0,
            'colis_livre'     => $this->colis ? $this->colis->where('status', 'livré')->count() : 0,
            'colis_retour'     => $this->colis ? $this->colis->where('status', 'return')->count() : 0,
            'phone'     => $this->phone,
            'agence'    => $this->agence,
            'role'      => $this->role,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
