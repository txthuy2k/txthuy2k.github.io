<?php

namespace App\Providers;

use App\Slider;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*',function($view){
            $banner = Slider::where('slider_status',1)->orderByRaw("RAND()")->first();
            $view->with(compact('banner'));
        });
    }
}
