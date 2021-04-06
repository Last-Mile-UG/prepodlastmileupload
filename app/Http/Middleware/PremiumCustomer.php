<?php

namespace App\Http\Middleware;

use Closure;

class PremiumCustomer
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
        if(auth()->check()){
            if(auth()->user()->role == 'customer' || auth()->user()->role == 'premium_customer')
            {
                if(!auth()->user()->customer_type)
                    return redirect()->route('premium');
                else
                    return $next($request);
            }
            else
                return $next($request); 
        }
        else
            return $next($request);
    }
}
