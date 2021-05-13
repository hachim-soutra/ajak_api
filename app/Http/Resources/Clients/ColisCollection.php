<?php

namespace App\Http\Resources\Clients;

use App\Http\Resources\Client\ColisResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ColisCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ColisResource::collection($this->collection);
    }
}
