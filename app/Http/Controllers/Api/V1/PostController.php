<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//Usamos el archivo creado para controlar las validaciones
use App\Http\Requests\PostRequest;

//Recursos
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //retornamos la coleccion pero paginada
        return new PostCollection(Post::paginate(10));

        /*Alternativo usando resource pero retornando todos los registors*/
        //return new PostCollection(Post::all());


        /*
         * Alternativa sin Resources
         * $posts = Post::all();
        return response()->json([
            'data' => $posts
        ], 201);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    //usamos el posrRquest que ya trae las reglas de validacion
    // en ves del Request solo
    public function store(PostRequest $request)
    {
        //le pasamos al modelo todo lo recibido por post y lo creamos
        $post = Post::create($request->all());



        return (new PostResource($post))
                ->response()
                ->setStatusCode(200);   // usando el recurso para retornar, y cambiano el codigo de status

        // forma convencional de retornr
        return response()->json([
            'data' => $post
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */

    public function show(Post $post)
    {


        PostResource::withoutWrapping(); //permite que no se retorne dentro del indice data

        //retornamos una clase, con el valor del post para que el recurso se encargue de la trasnformacion de la data a mostrar
        return new PostResource($post);

    //Como recibimos el post id en la peticion, podemos retornar el post por inyeccion se retorna todo lo encontrado en la consulta
       /* return response()->json([
            'data' => $post
        ], 200);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post $post
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
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //elimina el post pasado por parametro
        $post->delete();

        return response(null, 204);
    }
}
