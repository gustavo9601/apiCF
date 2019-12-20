<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author_id'
    ];

    //Un post tiene muchos comentarios
    public function comments(){
        return $this->hasMany('App\Models\Comment', 'id');
    }


    //Un post tiene un solo autor
    public function author(){
        //modelo a usar, llave de este modelo
        return $this->belongsTo('App\User', 'author_id');
    }
}
