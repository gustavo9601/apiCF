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
    "middleware" => ["auth:api"]  //middleware devalidacion
], function () {

    //apiResource crea rutas de recurso para apis
    //post => nombre del enpoint
    //PostContoller  // nombre del controllador


    //Route::apiResource('nameRuta', 'controlador');
    //Route::apiResources(['nameRuta'=> 'controlador']);  //cuando son varias rutas
    Route::apiResources([
        'posts' => 'PostController',
        'users' => 'UserController',
        'comments' => 'CommentController'
    ]);

    //Registrando rutas que serviran como relacion entre 2 tablas
    Route::get('/posts/{post}/relationships/author', 'PostRelationShipController@author')->name('posts.relationships.author');
    Route::get('/posts/{post}/author', 'PostRelationShipController@author')->name('posts.author');

    Route::get('/posts/{post}/relationships/comments', 'PostRelationShipController@comments')->name('posts.relationships.comments');
    Route::get('/posts/{post}/comments', 'PostRelationShipController@comments')->name('posts.comments');
});


Route::post('/login', [
    'as' => 'login',
    'uses' => 'Api\AuthController@login'
]);
Route::post('/signup', 'Api\AuthController@signup');


