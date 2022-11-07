<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class General
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (strpos($request->route()->uri(), "checkout") === false) {
            session()->forget('checkout-items');
            session()->forget('shipping-price');
            session()->forget('total-checkout-price');
            session()->forget('grandtotal-checkout-price');
            session()->forget('total-checkout-items');
            session()->save();
        }

        return $next($request);
    }
}
