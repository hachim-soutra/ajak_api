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
            'name'      => $this->user->name,
            'email'     => $this->user->email,
            'colis'     => $this->colis ? $this->colis->count() : 0,
            'colis_livre'     => $this->colis ? $this->colis->where('status', 'livré')->count() : 0,
            'colis_retour'     => $this->colis ? $this->colis->where('status', 'return')->count() : 0,
            'phone'     => $this->user->phone,
            'agence'    => $this->user->agence,
            'created_at' => $this->user->created_at->format('Y-m-d'),
        ];
    }
}
