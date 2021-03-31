<?php

namespace App\Providers;

use App\Http\Middleware\CheckRegion;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $host = parse_url(\URL::current())['host'];

        $region = null;
        if (preg_match("/^[a-zA-Z]*\.[a-z]*\.[a-z]*/", $host) > 0) {
            $region = explode('.', $host)[0];
        }

        if ($region) {
            session()->put('region', $region);
        }

        $this->routes(function () use ($region) {
            $routes = Route::middleware(['web', CheckRegion::class])
                ->namespace($this->namespace);

            if ($region) {
                $routes->domain("$region.".env('APP_BASE_URL'));
            }

            $routes->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
//        RateLimiter::for('api', function (Request $request) {
//            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
//        });
    }
}
