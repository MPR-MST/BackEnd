<?php

namespace App\Http\Controllers;

use App\Models\ImagesFacebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesFacebookController extends Controller
{
    public function store(Request $request)
    {
        // Check if an image file has been sent in the request
        // hasFile('') es un método de la clase 'Request'  que verifica si existe un archivo con el nombre
        // de entrada especificado en la solicitud
        if ($request->hasFile('image')) {
            // $request->file('key') --> Obtiene un objeto UploadedFile para un archivo cargado en la solicitud.
            // Store the image in the "public/images" folder and save the path in the application
            $image = $request->file('image')->store('public/images');
            //Añade la ruta a la variable $image
            $request->merge(['route' => $image]);

            $sizeInKB = $request->file('image')->getSize();

            // Create a new "ImagesFacebook" object and fill it with the request data
            $image = ImagesFacebook::create([
                'name' => $request->file('image')->getClientOriginalName(),
                'route' => $request->input('route'),
                'size' => $sizeInKB,
                'facebook_posts_id' => $request->input('facebook_posts_id'),
                'type' => $request->file('image')->getClientOriginalExtension(),
            ]);

            // Return a JSON response containing the created "image" object
            return response()->json(['image' => $image]);
        }

        // If no image file is found in the request, return a JSON response indicating that no image was uploaded.
        return response()->json(['message' => 'No image was uploaded']);
    }

    public function getAll(Request $request)
    {
        $images = ImagesFacebook::all()->map(function ($image) {
            // Obtiene la URL pública completa para el archivo de imagen almacenado en la propiedad "$image->route"
            // asset() genera la URL base de la app
            // Storage::url() obtiene la ruta del archivo dentro del sistema de almacenamiento de laravel
            $url = asset(Storage::url($image->route));
            // Asigna la URL obtenida anteriormente a una nueva propiedad llamada url en el objeto $image.
            $image->url = $url;
            // Elimina la propiedad "$image->route" del objeto $image, ya que no se necesita más después de obtener la URL.
            unset($image->route);
            return $image;
        });

        return response()->json($images);
    }
}
