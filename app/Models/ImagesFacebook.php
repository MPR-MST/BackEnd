<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesFacebook extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'route', 'type', 'size', 'description', 'facebook_posts_id'];

    public function facebookPost()
    {
        return $this->belongsTo(FacebookPost::class);
    }
}
