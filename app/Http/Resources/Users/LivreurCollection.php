<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LivreurCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => LivreurResource::collection($this->collection)
        ];
    }
}
