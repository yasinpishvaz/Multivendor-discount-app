<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\City;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        view()->composer(['front.secondnavbar'], function ($view) {
            $category = new Category();
            $categoryList = $category->tree();
            $view->with('categoryList', $categoryList);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
