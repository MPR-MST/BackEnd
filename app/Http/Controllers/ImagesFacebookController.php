<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesFacebookController extends Controller
{
  public function rules()
  {
    return [
      "name" => "required|min:5|max:500",
      "route" => "required|min:5|max:500|unique:posts, route",
      "type" => "required|min:5",
      "size" => "required",
      "description" => "required|min:10",
      "facebook_posts_id" => "required|integer"
    ];
  }
}
