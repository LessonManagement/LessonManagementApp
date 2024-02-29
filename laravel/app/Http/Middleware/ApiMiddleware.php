<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
    const USER = 'lessonmanagement_2024';
    const PASSWORD = 'lessonManagementPass_2024';
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
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
        // Comprobamos si las credenciales son válidas
        $result = false;
        if ($user == self::USER && $pass = self::PASSWORD)
            $result = true;
        return $result;
    }
}
