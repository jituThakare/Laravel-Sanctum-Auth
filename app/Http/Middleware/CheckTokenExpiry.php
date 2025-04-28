<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTokenExpiry
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->user()->currentAccessToken();
        dd($token);

        if ($token && $token->expires_at && $token->expires_at->isPast()) {
            return response()->json([
                'success' => false,
                'message' => 'Token expired. Please login again.',
            ], 401);
        }

        return $next($request);
    }
}
