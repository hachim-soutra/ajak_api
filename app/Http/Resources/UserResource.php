<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone'     => $this->user->phone,
            'agence'    => $this->agence,
            'role'      => $this->role,
            'created_at' => $this->created_at ?$this->created_at->format('Y-m-d') : '',
            'collaborators' => $this->collaborators() ? $this->collaborators()->count() : 0,
        ];
    }
}
