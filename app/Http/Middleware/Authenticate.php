<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
//            return response()->json(['message'=> "Unauthenticated"]);
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            return $next($request);
        }
        return redirect()->route('login');
    }

    protected function unauthenticated($request, array $guards)
    {
        abort(response()->json([
            'status' => 'failure',
            'message' => 'unauthenticated',], 401));

    }
}
