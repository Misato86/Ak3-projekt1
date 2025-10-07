<?php

namespace App\Http\Middleware;

class LowerCaseurls {
    public function handle($request, \Closure $next)
    {
        $path = $request -> path();
        if ($path !== strtolower($path)) {
            //Gör en redirect till lowercase url
            return redirect(strtolower($request -> getRequestUri()));
        }
        return $next($request);
    }
}