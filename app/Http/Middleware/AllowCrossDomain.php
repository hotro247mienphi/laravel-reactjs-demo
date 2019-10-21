<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class AllowCrossDomain
{
    /**
     * Handle an incoming request
     *
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {

        $headers = config('cors');

        if (strtoupper($request->getMethod()) === "OPTIONS") {
            return Response::make('OK', 200, $headers);
        }

        return $next($request)->withHeaders($headers);

    }
}
