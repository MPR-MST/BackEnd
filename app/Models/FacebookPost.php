<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookPost extends Model
{
    protected $fillable = ['tittle', 'date', 'url', 'active', 'content'];

    public function imagesFacebook(){
        return $this->hasOne(ImagesFacebook::class, "facebook_posts_id");
    }

    //public function videosFacebook(){
    //    return $this->hasMany(VideosFacebook::class);
    //}
}
