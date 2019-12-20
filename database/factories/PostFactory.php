<?php

use Faker\Generator as Faker;

use App\User;

$factory->define(App\Models\Post::class, function (Faker $faker) {



    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),  //tamaño, datos variables
        'author_id' => User::all()->random(),  //retorna aletariamente un valor del Modelo
        'content' => $faker->text($maxNBChars = 200)   //cantidad de letras
    ];
});
