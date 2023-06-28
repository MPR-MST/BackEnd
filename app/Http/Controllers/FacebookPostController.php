<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacebookPostRequest;
use App\Models\FacebookPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacebookPostController extends Controller
{
    /**
     * Get a list with all banner's posts
     */
    public function getAll(Request $request)
    {
        $posts = FacebookPost::join('facebook_images', 'facebook_posts.id', '=', 'facebook_images.facebook_posts_id')
            ->select('facebook_posts.*', 'facebook_images.route as imgFacebook')
            ->get()->map(function ($image) {
                $url = asset(Storage::url($image->imgFacebook));
                $image->urlFacebook = $url;
                unset($image->imgFacebook);
                return $image;
            })->map(function ($object) {
                $fecha = $object->date;
                $meses = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
                $fecha_timestamp = strtotime($fecha);
                setlocale(LC_TIME, 'es_ES');
                $mes = $meses[(int)date('m', $fecha_timestamp) - 1];
                $fecha_formateada = date('d', $fecha_timestamp) . " de " . $mes . " de " . date('y', $fecha_timestamp);
                $object->date = $fecha_formateada;
                return $object;

            });


        return response()->json($posts);
    }

    /**
     *  @param Facebookpost
     *  $post --> The post's id wich we want to see
     */
    public function get(FacebookPost $post)
    {
        //$post->load('images', 'videos.comments');
        return response()->json($post);
    }

    /**
     * Create post we receive
     * It has 3 layers:
     *  -->validator, to avoid mistakes
     *  -->fill, to set values
     *  -->save, to save data
     */
    public function create(FacebookPostRequest $request)
    {   //fill
        $post = new FacebookPost();
        $post->fill($request->all());

        //save
        if ($post->save()) {
            return response()->json($post);
        }
    }

    /**
     * Edit the post wich come from the id
     * @param FacebookPost
     * $post --> Post's id wich want to see
     * It has 3 layers:
     *  -->validator, to avoid mistakes
     *  -->fill, to set values
     *  -->save, to save data
     */
    public function update(FacebookPost $post,  FacebookPostRequest $request)
    {
        //fill 
        $post->fill($request->all());

        //save
        if ($post->save()) {
            return response()->json($post);
        }
    }

    /**
     * Delete the post wich come from the id
     * @param FacebookPost
     * $post --> Post's id wich want to see
     */
    public function delete(FacebookPost $post)
    {
        $post->delete();
        return response()->json($post);
    }
}
