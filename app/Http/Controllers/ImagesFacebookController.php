<?php

namespace App\Http\Controllers;

use App\Models\ImagesFacebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesFacebookController extends Controller
{
  public function store(Request $request)
  {
      // Verifies if the image file is present in the request
    if ($request->hasFile('image')) {

      // Stores the image in the "public/images" folder and saves the path in the application
      $image = $request->file('image')->store('public/images');
      $request->request->add(['route' => $image]);

      $sizeInKB = $request->file('image')->getSize();

      // Creates a new "ImagesFacebook" object and fills it with the request data
      $image = ImagesFacebook::create([
        'name' => $request->file('image')->getClientOriginalName(),
        'route' => $request->route,
        'size' => $sizeInKB,
        'facebook_posts_id' => $request->input('facebook_posts_id'),
        'type' => $request->file('image')->getClientOriginalExtension(),
      ]);

      // Returns a JSON response containing the created "image" object
      return response()->json(['image' => $image]);
    }
    // If no image file is found in the request, returns a JSON response indicating that no image was uploaded.
    return response()->json(['message' => 'No image was uploaded']);
  }

  public function getAll(Request $request) {
    $images = ImagesFacebook::all()->map(function ($image) {
        $url = asset(Storage::url($image->route));
        $image->url = $url;
        unset($image->route);
        return $image;
    });
    
    return response()->json($images);
  }

}