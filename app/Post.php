<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['judul', 'isi', 'foto', 'tema_id'];

    public function tema(){
        return $this->belongsTo('App\Tema');
    }
}
