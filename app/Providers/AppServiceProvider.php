<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        // Schema::defaultStringLength(191);

        // $this->writeDbLog();

    }

    public function writeDbLog()
    {
        $file = storage_path('/logs/query.log');

        DB::listen(function ($query) use ($file) {
            $content = str_repeat('-', 120) . PHP_EOL;
            $content .= $query->sql . PHP_EOL . var_export($query->bindings, true) . PHP_EOL;
            File::append($file, $content);
        });
    }
}
