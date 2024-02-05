<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // return response($user, 201);
        if ($user && $user->user_groupe_id === 1) {
            return $next($request);
        }

        return response('Unauthorized', 401);
    }
}
