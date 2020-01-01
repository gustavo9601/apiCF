<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    /*
     * Para que PHPUnit ejecute el método como una prueba, debes colocar la anotación /** @test
     * antes de la declaración del método o colocar el prefijo test_ en el nombre del método como tal:
     * */


    use WithFaker;  //usamos faker en los test
    use RefreshDatabase;  // se ejecutara cuando se llame la clase y reseteara los valores por default de la BD


    public function test_stores_posts()
    {

        $user = create('App\User');  //genera un modelo de usuario

        $data = [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),  //tamaño, datos variables
            'content' => $this->faker->text($maxNBChars = 200),   //cantidad de letras
            'author_id' => $user->id  //retorna aletariamente un valor del Modelo
        ];

        //Para probar el api
        //verbo de accion, url endpoint, informacion
        $response = $this->json('POST', $this->baseUrl . "posts", $data);


        //var_dump($this->baseUrl . "posts");

        $response->assertStatus(201);  //valida que la respuesta sea un 201
        $this->assertDatabaseHas('posts', $data); // valida en la tabla pasada por parametro, el arreglo como segundo parametro este como registro



        $post = Post::all()->first();
        //Verifica que los atirbutos se contengan en el json
        $response->assertJson([
           'data' => [
               'id' => $post->id,
               'title' => $post->title
           ]
        ]);

    }



    public function test_deletes_posts(){


        create('App\User');
        $post = create('App\Models\Post');

        $response = $this->json('DELETE', $this->baseUrl . "posts/" . $post->id);

        $response->assertStatus(204);  //verifica que retorne el codigo


        $this->assertNull(Post::find($post->id)); //verifica si eletorno a la consulta en sula


    }



    public function test_updates_posts(){


        $data = [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),  //tamaño, datos variables
            'content' => $this->faker->text($maxNBChars = 200),   //cantidad de letras
        ];


        create('App\User');
        $post = create('App\Models\Post');

        $response = $this->json('PUT', $this->baseUrl . "posts/" . $post->id, $data);
        $response->assertStatus(200);

        $post = $post->fresh();  //retorna al objeto actualizado


        //Verfifica el primer campo sea igual con el segundo
        $this->assertEquals($post->title, $data['title']);
        $this->assertEquals($post->content, $data['content']);


    }


    public function test_shows_posts(){
        create('App\User');
        $post = create('App\Models\Post');


        $response = $this->json('GET', $this->baseUrl . 'posts/' . $post->id);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $post->id,
                'title' => $post->title
            ]
        ]);

    }


    public function test_get_all_posts(){

        $response = $this->json('GET', $this->baseUrl . 'posts');

        $response->assertStatus(201);


    }

}
