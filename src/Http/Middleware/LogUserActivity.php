<?php

namespace LaravelActivityLogger\Http\Middleware;

use Closure;
use LaravelActivityLogger\Facades\ActivityLogger;

class LogUserActivity
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            ActivityLogger::log('route_accessed', null, $request->path());
        }

        return $next($request);
    }
}
