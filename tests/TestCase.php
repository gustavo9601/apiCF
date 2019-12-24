<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    //variable de ejemplo para usar como ruta para las pruebas
    public $baseUrl = "/api/v1/";
}
