<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;
use App as Kapp; 

class Localization
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
        if (session()->has('locale')) {
            Kapp::setLocale(session()->get('locale'));
        }
        else if (Auth::check())
        {
            $user = auth()->user();
            $lang = $user->language;
            Kapp::setLocale($lang);
            session()->put('locale', $lang);
        }

        return $next($request);
    }
}
