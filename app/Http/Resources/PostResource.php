<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;



class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $user = \Auth::user();  //devuelve el objeto del usuario autenticado



        //$this  apunta al parametro al modelo que se le envie por parametro
       return [
           'id' => $this->id,
           'type' => $this->getTable(),   //retorna el nombre de la tabla en la BD
            'attributies' => [
                'title' => $this->title
            ],
               'relationships' => new PostRelationShipResource($this),   //llamamos otro recurso, pero para organizarlo lo separamos
           'links' => [
               'self' => route('posts.show', ['posts' => $this->id])  //route(nombre de la ruta, parametros que recibe la url)
           ],
           //usando el mergeWhen() que heradomos de JsonResource
           //podemos hacer condicionales en el primer parametor, de cumplirse adiciona lo que se le pase en el segundo parametro

            //$user->isAdmin()  -> funcion del modelo user, que devuelve la columna admin = 1 o 0
            $this->mergeWhen(($user->isAdmin()), [
                'created' => $this->created_at,
            ])
       ];
    }
}
