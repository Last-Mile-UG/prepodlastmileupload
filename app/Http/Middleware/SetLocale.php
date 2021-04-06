<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $availLanguage = ['en','ge'];
        $local = session('App_LOCAL');
        $local = in_array($local,$availLanguage) ? $local: config('app.locale'); 
        app()->setlocale($local);
        return $next($request);
    }
}
