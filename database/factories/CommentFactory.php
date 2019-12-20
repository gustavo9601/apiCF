<?php

use Faker\Generator as Faker;


use App\User;
use App\Models\Post;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text($maxNBChars = 200),   //cantidad de letras
        'user_id' => User::all()->random(),  //retorna aletariamente un valor del Modelo
        'post_id' => Post::all()->random()
    ];
});
