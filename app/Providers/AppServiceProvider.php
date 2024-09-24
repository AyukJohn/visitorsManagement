<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Model::creating(function ($model) {
        //     $model->created_at = Carbon::now('Africa/Lagos'); // Or 'UTC' for storage in UTC
        // });

        date_default_timezone_set('Africa/Lagos');

        Schema::defaultStringLength(191);
    }
}
