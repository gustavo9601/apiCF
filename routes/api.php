<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    "prefix" => "v1",  //le adiciona al path /v1
    "namespace" => 'Api\V1',  // Le iindica el directorio donde buscar los controladores
    //"middleware" => ["auth:api"]  //middleware devalidacion
], function(){

    //apiResource crea rutas de recurso para apis
    //post => nombre del enpoint
    //PostContoller  // nombre del controllador
    Route::apiResource('posts', 'PostController');

});
