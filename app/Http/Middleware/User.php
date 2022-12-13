<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
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
        if (Auth::check()) {
            // if (strpos($request->route()->uri(), "checkout") === false) {
            if (!preg_match("/.*(checkout).*/", $request->route()->uri())) {
                session()->forget([
                    'checkout-items',
                    'total-checkout-price',
                    'grandtotal-checkout-price',
                    'total-price-after-discount',
                    'shipping-voucher-used',
                    'product-voucher-used',
                    'total-checkout-items',
                    'total-discount-product',
                    'total-discount-shipping'
                ]);
            }
            

            if (Auth::user()->role_id == 1) {
                return $next($request);
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');
        }
    }
}
