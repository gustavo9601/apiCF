<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
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
          PostResource::collection($this->collection)  //retornara una coleccion de PostResource
                                                        //$this->collection hace referencia a la coleccion de datos recibidas por el modelo
        ];
    }
}
