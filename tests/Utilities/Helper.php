<?php


function create($class, $attr = [])
{
    //retornaremos una fabrica, de la clase por paraemtro y pasando los parametros
    return factory($class)->create($attr);
}