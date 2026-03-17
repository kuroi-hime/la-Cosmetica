<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * 
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        try{
            $token = JWTAuth::fromUser($user);
            // bon pratique : authentification automatique après inscription
            JWTAuth::attempt($request->only('email', 'password'));
        }catch(JWTException $e){
            // Internal server error :500
            return response()->json(['error' => 'erreur lors de la création de token.'], 500);
        }

        // Requête création réussie :201
        return response()->json([
            // 'user' => $user,
            // 'role' => $user->role,
            'token' => $token
        ], 201);
    }

    /**
     * 
     */
    public function login(LoginRequest $request)
    {
        $identifients = $request->only('email', 'password');

        // Connexion en utilisant le token
        $token = JWTAuth::attempt($identifients);
        if(!$token)
            return response()->json(['error' => 'Identifiants incorrects.'], 401);

        return response()->json(['token' => $token]);
    }

    /**
     * 
     */
    public function logout()
    {
        try
        {
            auth()->logout();
            return response()->json(['message' => 'Vous êtes déconnecté.']);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => 'Erreur lors de déconnexion.']);
        }
        
    }
}
