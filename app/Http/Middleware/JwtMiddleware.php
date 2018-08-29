<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->get('api_token');
        if (! $token) {
            // Unauthorized response if token not there
            return response()->json([
                'success' => false,
                'message' => 'Token not provided.',
            ]);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Provided token is expired.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error while decoding token.',
            ]);
        }
        $user = User::find($credentials->sub); //find user by id

        // put the user in the request class so we can grab it from there
        $request->auth = $user;

        return $next($request);
    }
}