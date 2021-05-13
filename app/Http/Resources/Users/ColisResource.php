<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class ColisResource extends JsonResource
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
            "agence"            => $this->agence,
            "ville_depart"      => $this->ville_depart,
            "ville_arrive"      => $this->ville_arrive,
            "status"            => $this->status,
            "phone"             => $this->phone,
            "produit"           => $this->produit,
            "user"              => $this->user,
            "client"            => $this->client,
            "date_livraison"    => $this->date_livraison,
            "date_arrive"       => $this->date_arrive,
            "description"       => $this->description,
            "montant"           => $this->montant,
            "token"             => $this->token,
            "adresse"           => $this->adresse,
            "created_at"        => $this->created_at->format('Y-m-d H:m:s'),
            "livreur"           => $this->livreur,
        ];
    }
}
