<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Model
use App\Models\Post;

//resource
use App\Http\Resources\UserResource;
use App\Http\Resources\CommentResource;

class PostRelationShipController extends Controller
{
    public function author(Post $post){


        //$post->author
        //hace referencia a la relacion del modelo entre post y author que esta en el modelo post
        return new UserResource($post->author);
    }

    public function comments(Post $post){
        // con colection retornara una coleccion "arreglo" en el formato de CommentResource
        return CommentResource::collection($post->comments);
    }
}
