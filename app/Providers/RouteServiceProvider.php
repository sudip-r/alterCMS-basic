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
   * The path to the "home" route for your application.
   *
   * This is used by Laravel authentication to redirect users after login.
   *
   * @var string
   */
  public const HOME = '/alter-admin/dashboard';

  /**
   * The controller namespace for the application.
   *
   * When present, controller route declarations will automatically be prefixed with this namespace.
   *
   * @var string|null
   */
  protected $namespace = 'App\\Http\\Controllers';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();

    $this->configureRateLimiting();

    $this->routes(function () {
      Route::prefix('api')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));

      Route::middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));

      Route::prefix('alter-admin')
        ->as('cms::')
        ->middleware(['web', 'auth:web'])
        ->namespace('App\Http\Controllers\alterCMS')
        ->group(base_path('routes/cms.php'));

      Route::prefix('cms-api')
        ->as('api::')
        ->middleware(['web', 'auth:web'])
        ->namespace('App\Http\Controllers\alterCMS\API')
        ->group(base_path('routes/cms-api.php'));

      Route::prefix('business')
        ->as('business::')
        ->middleware(['web', 'auth:business'])
        ->namespace('App\Http\Controllers\Business')
        ->group(base_path('routes/business.php'));

      Route::prefix('client')
        ->as('client::')
        ->middleware(['web', 'auth:client'])
        ->namespace('App\Http\Controllers\Client')
        ->group(base_path('routes/client.php'));

    });
  }

  /**
   * Configure the rate limiters for the application.
   *
   * @return void
   */
  protected function configureRateLimiting()
  {
    RateLimiter::for('api', function (Request $request) {
      return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
    });
  }
}
