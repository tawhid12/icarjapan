<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Settings\Country;

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
        // Check if the user has selected a country (e.g., using session or user profile)
        if (!session()->has('countryName') && !session()->has('location')) {
            //return redirect()->route('front');
            $countries = Country::all();
            return view('front.country-select', compact('countries'));
        }

        return $next($request);
    }
}
