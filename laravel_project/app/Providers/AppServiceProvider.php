<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        Paginator::useBootstrap();

        # 商用環境以外だった場合、SQLログを出力する
        if (config('app.env') !== 'production') {
            DB::listen(function ($query) {
                Log::info("Query Time:{$query->time}s] $query->sql");
            });
        }
    }
}
