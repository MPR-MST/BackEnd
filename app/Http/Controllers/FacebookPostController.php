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
        // Get all FacebookPost records joined with facebook_images using the 'id' and 'facebook_posts_id' fields
        $posts = FacebookPost::join('facebook_images', 'facebook_posts.id', '=', 'facebook_images.facebook_posts_id')
            ->select('facebook_posts.*', 'facebook_images.route as imgFacebook')
            ->get()
            ->map(function ($image) {
                // Generate the full URL of the image using the asset() function and the 'route' stored in the 'facebook_images' table
                $url = asset(Storage::url($image->imgFacebook));

                // Add the 'urlFacebook' property to the $image object and assign it the generated URL
                $image->urlFacebook = $url;

                // Remove the 'imgFacebook' property from the $image object
                unset($image->imgFacebook);

                // Return the modified $image object
                return $image;
            })
            ->map(function ($object) {
                // Get the date from the $object
                $date = $object->date;
                // Define the names of the months in German
                $months = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
                // Convert the date to a timestamp format
                $date_timestamp = strtotime($date);
                // Set the locale to German
                setlocale(LC_TIME, 'de_DE');
                // Get the month name corresponding to the date and assign it to the $month variable
                $month = $months[(int)date('m', $date_timestamp) - 1];
                // Format the date with the day, month, and year in the specified format ('01. January 2023')
                $formated_date = date('d', $date_timestamp) . ". " . $month . " " . date('Y', $date_timestamp);
                // Replace the 'date' property of the $object with the formatted date
                $object->date = $formated_date;
                // Return the modified $object
                return $object;
            });

        // Return a JSON response with the $posts objects
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
