<?php

use App\Http\Controllers\FacebookPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('facebookPosts')->middleware('throttle:10')->group(function () {
    Route::get('/list', [FacebookPostController::class, 'getAll']); //api/facebookPosts/list
    Route::get('/{post}', [FacebookPostController::class, 'get']); //api/facebookPosts/23
    Route::post('/', [FacebookPostController::class, 'create']);
    Route::put('/{post}', [FacebookPostController::class, 'update']);
    Route::delete('/{post}', [FacebookPostController::class, 'delete']); //api/facebookPosts/23
});
