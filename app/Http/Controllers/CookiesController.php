<?php

namespace App\Http\Controllers;
use App\Models\Cookie;
use Illuminate\Http\Request;

class CookiesController extends Controller
{

    public function getAll(Request $request)
    {
        return response()->json(Cookie::all());
    }

    public function get(Cookie $cookies)
    {
        return response()->json($cookies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function postCookies(Request $request)
    {
       $cookies = new Cookie();

       $cookies-> ip = request()->ip();
       $cookies-> accepted = true; 
       $cookies-> browser = request()->header('User-Agent');
       $cookies->save();

       return response()->json($cookies);  
    }
}
