<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use App;
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

        Session::put('locale', Config::get('app.locale'));
        App::setLocale(Session::get('locale'));

        return $next($request);
    }
}