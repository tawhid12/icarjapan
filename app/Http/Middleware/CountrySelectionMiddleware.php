<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CountrySelectionMiddleware
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
        /*$request->session()->forget('countryName');
        $request->session()->forget('location');*/

        /*echo '<pre>';
        print_r($request->session());die;*/
        // Check if the user has selected a country (e.g., using session or user profile)
        if (!$request->session()->has('countryName') && !$request->session()->has('location')) {
            return redirect()->route('front');
        }
        /*$request->session()->forget('countryName');
        $request->session()->forget('location');*/
        return $next($request);
    }
}