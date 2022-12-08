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
        // if (strpos($request->route()->uri(), "checkout") === false) {
        if (!preg_match("/.*(checkout).*/", $request->route()->uri())) {
            session()->forget([
                'checkout-items',
                'shipping-price',
                'total-checkout-price',
                'grandtotal-checkout-price',
                'total-checkout-items'
            ]);
        }
        
        return $next($request);
    }
}
