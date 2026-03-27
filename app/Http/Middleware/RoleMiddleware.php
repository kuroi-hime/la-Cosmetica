<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        try{
            $real_role = JWTAuth::parseToken()->getPayLoad()->get('role');

            if($real_role == $role)
                return $next($request);
            else
                return response()->json(['erreur' => 'Non autorisé.'], 403);

        }catch(JWTException $e){
            return response()->json(['erreur' => 'Non authentifié(e).'], 401);
        }
        
    }
}
