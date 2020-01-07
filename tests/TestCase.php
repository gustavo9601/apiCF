<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Laravel\Passport\Passport;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    //variable de ejemplo para usar como ruta para las pruebas
    public $baseUrl = "/api/v1/";


    /*Modificando los test para utlizcen la autencticacion de laravel passport*/
    public function sigin(){
        //cremoos un modelo de usuario
        $user = create('App\User');
        //crea la instancia de prueba de la autoenciacion con el modelo pasado
        Passport::actingAs($user);
    }

    public function setUp() : void{

        parent::setUp();
        //se ejecutara en cada test realizado
        $this->sigin();
    }
}
