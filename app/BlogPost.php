<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    //These are mass assignable properties that you want the user to modify
    protected $fillable = ['title', 'content'];

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
