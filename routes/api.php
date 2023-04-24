<?php

use App\Http\Controllers\FacebookPostController;
use App\Http\Controllers\ImagesFacebookController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('throttle:10')->group(function () {
//Commented for security
//Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('facebookPosts')->middleware('throttle:10')->group(function () {
    Route::get('/list', [FacebookPostController::class, 'getAll']); //api/facebookPosts/list
    Route::get('/{post}', [FacebookPostController::class, 'get']); //api/facebookPosts/23
    Route::middleware('auth:sanctum')->post('/', [FacebookPostController::class, 'create']); //api/facebookPosts/
    Route::middleware('auth:sanctum')->put('/{post}', [FacebookPostController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('/{post}', [FacebookPostController::class, 'delete']); //api/facebookPosts/23
});

Route::prefix('facebookImages')->middleware('throttle:10')->group(function () {
    Route::get('/list', [ImagesFacebookController::class, 'getAll']); //api/facebookImages/list
    //Route::get('/{image}', [ImagesFacebookController::class, 'get']); //api/facebookImages/23
    Route::middleware('auth:sanctum')->post('/upload', [ImagesFacebookController::class, 'store']); //api/facebookImages/upload
    //Route::middleware('auth:sanctum')->put('/{image}', [ImagesFacebookController::class, 'update']);
    //Route::middleware('auth:sanctum')->delete('/{image}', [ImagesFacebookController::class, 'delete']); //api/facebookImages/23
});

Route::prefix('contact-us')->middleware('throttle:10')->group(function () {
    Route::middleware('auth:sanctum')->get('/list', [ContactController::class, 'getAll']); //api/contact-us/list
    Route::middleware('auth:sanctum')->get('/{contact}', [ContactController::class, 'get']); //api/contact-us/23
    Route::middleware('auth:sanctum')->delete('/{contact}', [ContactController::class, 'delete']); //api/contact-us/23
});

Route::prefix('cookies')->middleware('throttle:10')->group(function () {
    Route::middleware('auth:sanctum')->get('/list', [CookiesController::class, 'getAll']); //api/cookies/list
    Route::middleware('auth:sanctum')->get('/{cookies}', [CookiesController::class, 'get']); //api/cookies/23
    Route::post('/', [CookiesController::class, 'postCookies'])->name('cookies.store');
});