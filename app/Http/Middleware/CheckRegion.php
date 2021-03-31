<?php

namespace App\Http\Middleware;

use App\Models\Region;
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
        $session = session();
        if (!$session->has('region')) {
            return $next($request);
        }

        if (Region::whereAlias($session->get('region'))->exists()) {
            return $next($request);
        }

        return redirect(\URL::formatScheme().env('APP_BASE_URL'));
    }
}
