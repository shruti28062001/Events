<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
 

class AuthenticateWithApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'API token missing'], 401);
        }

        $apiKey=env('API_KEY');

        if ( $token !== $apiKey) {
            return response()->json(['error' => 'Invalid API token'], 401);
        }

        return $next($request);
    }
}
