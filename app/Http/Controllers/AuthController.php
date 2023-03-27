<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // User validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        
        // Create a new user in database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate auth token
        $token = $user->createToken('authToken')->plainTextToken;

        // Response JSON with generated token
        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        // Validate the user credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // User auth and remember user
        if (Auth::attempt($credentials, $request->remember)) {
            // Generate auth token
            $token = $request->user()->createToken('authToken')->plainTextToken;
            // JSON response with generated token
            return response()->json(['token' => $token], 200);
        } else {
            // JSON error response if credentials are incorrect
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}

//Por qué se generan 2 tokens de autenticación, 
//no se supone que se genera un token 2 usuario y ese se guarda en cookies o storage?