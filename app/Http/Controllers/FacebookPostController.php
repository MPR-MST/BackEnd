<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacebookPostRequest;
use App\Models\FacebookPost;
use Illuminate\Http\Request;

class FacebookPostController extends Controller
{
    /**
     * Get a list with all banner's posts
     */
    public function getAll(Request $request)
    {
        return response()->json(FacebookPost::all()->load("imagesFacebook"));
    }

    /**
     *  @param Facebookpost
     *  $post --> The post's id wich we want to see
     */
    public function get(FacebookPost $post)
    {
        //$post->load('images', 'videos.comments');
        return response()->json($post->load("imagesFacebook"));
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
    public function delete(FacebookPost $post){
        $post->delete();
        return response()->json($post);
    }
}
