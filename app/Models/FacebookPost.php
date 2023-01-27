<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookPost extends Model
{
    protected $fillable = ['title', 'date', 'url', 'active', 'content', 'image'];

    public function image(){
        //relation with images
    }

    public function videos(){
        //relation with videos
    }
}
