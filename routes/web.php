<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

// para clase
use App\Models\FacebookPost;

Route::get('hello', function () {



    // $fb = FacebookPost::find(1)->imagesFacebook()->get();
    // dump($fb);

    $fb1 = FacebookPost::with('imagesFacebook')->get();
    


    return 0;
});
// para clase