<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class ReturnColisResource extends JsonResource
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
            "name"              => $this->colis->name,
            "agence"            => $this->colis->agence,
            "ville_depart"      => $this->colis->ville_depart,
            "ville_arrive"      => $this->colis->ville_arrive,
            "status"            => $this->colis->status,
            "phone"             => $this->colis->phone,
            "produit"           => $this->colis->produit,
            "user"              => $this->colis->user,
            "livreur"           => $this->colis->livreur,
            "client"            => $this->colis->client,
            "date_livraison"    => $this->colis->date_livraison,
            "date_arrive"       => $this->colis->date_arrive,
            "description"       => $this->colis->description,
            "montant"           => $this->colis->montant,
            "token"             => $this->colis->token,
            "adresse"           => $this->colis->adresse,
            "created_at"        => $this->created_at->format('Y-m-d H:m:s'),
            "livreur"           => $this->colis->livreur,
        ];
    }
}
