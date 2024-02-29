<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user;
        $pass = $request->password;
        if ($this->credentialsAreValid($user, $pass)) {
            return $next($request);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    private function credentialsAreValid($user, $pass)
    {
        $result = false;
        if ($user == config('credentials.api_username') && $pass == config('credentials.api_password'))
            $result = true;
        return $result;
    }
}
