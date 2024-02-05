<?php

namespace App\Http\Middleware;

use Closure;
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // return response($user, 201);
        if ($user && $user->user_groupe_id === 3) {
            return $next($request);
        }

        return response('Unauthorized', 401);
    }
}
