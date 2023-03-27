<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

//Route::get('contact-us', [ContactController::class, 'index']);
Route::post('contact-us/store', [ContactController::class, 'store'])->name('contact.us.store');