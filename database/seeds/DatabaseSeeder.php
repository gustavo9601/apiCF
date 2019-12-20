<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //Creando usuarios
        factory(\App\User::class)->times(50)->create();

        //Creando post
        factory(\App\Models\Post::class)->times(10)->create();

        //Creando comentarios
        factory(\App\Models\Comment::class)->times(20)->create();


    }
}
