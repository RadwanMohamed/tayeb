<?php

namespace App\Providers;

use App\Order;
use App\Promotion;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        Promotion::updated(function ($code){
            if ($code->count < 1 && $code->status == Promotion::ACTIVATED)
            {
                $code->status = Promotion::EXPIRED;
                $code->save();
            }
        });

    }
}
