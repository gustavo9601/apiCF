<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//Usamos el archivo creado para controlar las validaciones
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //usamos el posrRquest que ya trae las reglas de validacion
    // en ves del Request solo
    public function store(PostRequest $request)
    {
        //le pasamos al modelo todo lo recibido por post y lo creamos
        $post = Post::create($request->all());

        return response()->json([
           'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */


    //usamos el posrRquest que ya trae las reglas de validacion
    // en ves del Request solo
    public function update(Request $request, Post $post)
    {

       $post->update($request->all());

        return response()->json([
            'data' => $post
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //elimina el post pasado por parametro
        $post->delete();

        return response(null, 204);
    }
}
