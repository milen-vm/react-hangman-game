<?php

namespace App\Providers;

use App\Http\Services\Contracts\GalleryServiceInterface;
use App\Http\Services\GalleryService;
use App\Models\Gallery;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GalleryServiceInterface::class, function () {
            return  new GalleryService(new Gallery());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
