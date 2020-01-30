<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCommentRelationshipCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // capturamos el arreglo adicional enviado a este recurso
        $posts = $this->additional['posts'];

        return [
            'data' => CommentIdentifierResource::collection($this->collection),  //de esta forma usamos el recurso CommentIdenti... como una collection para que se itere por todos los registros
            'links' => [
                'self' => route('posts.relationships.comments', ['posts' => $posts]),
                'related' => route('posts.comments', ['posts' => $posts])
            ]
        ];
    }
}
