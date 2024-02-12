<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RootMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $actualUser = $request->user();
        if($actualUser == null) {
            return redirect('login');
        }
        if($actualUser->type != 'root') {
            return redirect('/');
        }
        return $next($request);
    }
}
