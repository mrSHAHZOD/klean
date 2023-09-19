<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFour();

        View::composer('components.navbar', function ($view) {
            $view->with('current_locale',  App::currentLocale() );
            $view->with('all_locale', ['uz', 'en','ru'], config('app.all_locales'));

        });
    }
}
