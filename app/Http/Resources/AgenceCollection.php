<?php

namespace App\Http\Resources;

use App\Http\Resources\AgenceResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AgenceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return AgenceResource::collection($this->collection);
    }
}
