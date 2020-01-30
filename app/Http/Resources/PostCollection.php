<?php

namespace App\Http\Resources;

use App\User;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\UserResource;

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

    // la funcion with se pusheara al arreglo de salida final automaticamente
    // debajo del meta
    public function with($request)
    {


        $authors = $this->collection->map(
          function($post){   // recorrera la coleccion, y en post devolvera cada objeto iterado
              return $post->author;
          }
        );


        $comments = $this->collection->flatMap(
          function($post){
              return $post->comments;
          }
        );

        $include = $authors->merge($comments);


        // si lo colocamos 'links' al indice se inserta dentro del arreglo global links
        return [
          'links' => [
            'self' => route('posts.index')
          ],
           'included' => [
                $include->map(function ($item){

                    if($item instanceof User){
                        return new UserResource($item);
                    }else if ($item instanceof Comment){
                        return new CommentResource($item);
                    }

                })
           ]
        ];
    }
}
