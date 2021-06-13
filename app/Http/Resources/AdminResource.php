<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'colis'     => $this->userable->colis ? $this->userable->colis->count() : 0,
            'phone'     => $this->phone,
            'agence'    => $this->agence,
            'role'      => $this->userable->role,
            'status'      => $this->status,
            'created_at' => $this->created_at ?$this->created_at->format('Y-m-d') : '',
            'collaborators' => $this->userable->collaborators() ? $this->userable->collaborators()->count() : 0,
        ];
    }
}
