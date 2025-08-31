<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;
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
        Schema::defaultStringLength(191);
        View::composer(['frontend.*', 'User.*'], function ($view) {
            $categories = cache()->remember('categories', 60 * 60, function () {
                return Category::where('id', '!=', 31)->get();
            });
            $view->with('categories', $categories);
        });
    }
}
