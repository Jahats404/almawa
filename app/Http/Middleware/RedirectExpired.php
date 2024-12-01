<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectExpired
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->status() === Response::HTTP_UNAUTHORIZED || $response->status() === 419) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }

        return $response;
    }
}