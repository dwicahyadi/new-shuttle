<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        if(Schema::hasTable('settings'))
        {
            config([
                'settings' => \App\Models\Setting::all([
                    'name','value'
                ])
                    ->keyBy('name')
                    ->transform(function ($setting) {
                        return $setting->value;
                    })
                    ->toArray()
            ]);
        }
        Paginator::useBootstrap();
    }
}
