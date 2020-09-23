<?php

namespace Yource\ExactOnlineClient;

use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilderRequest;

class ExactOnlineClientServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/navitia-client-laravel.php' => config_path('navitia-client-laravel.php'),
        ]);
    }

    public function register()
    {
//        $this->app->bind(NavitiaClient::class, function ($app) {
//            return new NavitiaClient();
//        });

        $this->app->singleton(NavitiaClient::class, function () {
            return new NavitiaClient();
        });
    }
}
