<?php

namespace App\Http\Middleware;

use App\Models\Region;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class CheckRegion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$region = RouteServiceProvider::getRegion()) {
            return $next($request);
        }

        if (Region::whereAlias($region)->exists()) {
            return $next($request);
        }

        RouteServiceProvider::setRegion();
        return redirect(\URL::formatScheme().env('APP_BASE_URL'));
    }
}
