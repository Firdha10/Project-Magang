<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $table = 'temas';
    protected $fillable = ['tema'];

    public function post(){
        return $this->hasMany(Post::class);
    }
}
