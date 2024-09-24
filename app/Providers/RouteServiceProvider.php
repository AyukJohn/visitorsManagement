<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            //Load module routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            $this->mapModuleRoutes();

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        
    }

    // Load All Module routes
    protected function mapModuleRoutes() : void
    {
        $path = base_path('modules/');
        $pattern = '*'; // All files
        $dirs = glob($path . $pattern);

        foreach ($dirs as $key => $fullpath) {
            list($baseDir, $moduleName) = explode($path, $fullpath);

            // $routes_path = $fullpath.'/Api/routes.php';

            $versionDirs = glob($fullpath . '/Api/' . $pattern);

            foreach ($versionDirs as $versionPath) {
                $routePath =$versionPath . '/routes.php';
                if (file_exists($routePath))
                    Route::middleware('api')
                        ->prefix('api')
                        ->group($routePath);
            }
        }
    }
}
