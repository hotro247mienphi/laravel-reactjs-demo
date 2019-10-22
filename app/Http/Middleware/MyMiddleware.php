<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class MyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->merge(['author' => 'NGuyen Duc THuan']);
        return $next($request);
    }

    /**
     * work after the HTTP response has been sent to the browser
     *
     * @param Request $request
     * @param Response $response
     */
    public function terminate(Request $request, Response $response)
    {
        $content = sprintf('%s:: %s %s %s',
            now()->format('Y-m-d H:i:s'),
            $request->fullUrl(),
            $request->getPort(),
            http_build_query($request->all())
        );

        $content .= PHP_EOL . $response->getStatusCode() . PHP_EOL;
        File::append(storage_path('logs/terminate.log'), $content );
    }
}
