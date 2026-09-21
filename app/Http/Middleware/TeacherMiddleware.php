<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next, string $access = 'auth'): Response
    {
        $authenticated = Auth::guard('teacher')->check();

        if ($access === 'guest' && $authenticated) {
            $response = redirect()->route('teacher.dashboard');
        } elseif ($access === 'auth' && ! $authenticated) {
            $response = redirect()->route('teacher.login');
        } else {
            $response = $next($request);
        }

        return $response;
    }
}
