<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AuthorIdentifierResource;
use App\Http\Resources\PostCommentRelationshipCollection;

class PostRelationShipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'author' => [
                'links' => [
                    'self' => route('posts.show', ['post' => $this->id]),
                    'related' => route('posts.relationships.author', ['post' => $this->id])
                ],
                'data' => new AuthorIdentifierResource($this->author)  //le pasamos la relacion del modelo
            ],
            'comments' => new PostCommentRelationshipCollection($this->comments)  //le pasamos la relacion del demolo , "comments"
        ];
    }
}
