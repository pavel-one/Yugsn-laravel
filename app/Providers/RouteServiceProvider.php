<?php

namespace App\Providers;

use App\Http\Middleware\CheckRegion;
use App\Models\Region;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const REGION_KEY = 'region';

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

        self::setRegion($region);

        $this->routes(function () use ($region) {
            $routes = Route::middleware(['web', CheckRegion::class])
                ->namespace($this->namespace);

            if ($region) {
                $routes->domain("$region." . env('APP_BASE_URL'));
            }

            $routes->group(base_path('routes/web.php'));
        });
    }

    public static function getRegion(): ?string
    {
        if (!session()->has(self::REGION_KEY)) {
            return null;
        }

        return session()->get(self::REGION_KEY);
    }

    public static function setRegion(string $region = null): bool
    {
        session()->remove(self::REGION_KEY);
        if ($region) {
            session()->put(self::REGION_KEY, $region);
        }

        return true;
    }

    public static function getCurrentRegionId(): ?int
    {
        if (!$region = self::getRegion()) {
            return null;
        }

        return \Cache::remember('region_id_' . $region, 60 * 60 * 12, function () use ($region) {
            return Region::whereAlias($region)->first()->id;
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
