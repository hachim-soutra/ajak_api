<?php

namespace App\Http\Resources;

use App\Http\Resources\RammasageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RammasageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return RammasageResource::collection($this->collection);
    }
}
