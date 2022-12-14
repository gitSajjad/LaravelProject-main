<?php

namespace App\Providers;

use App\Models\Admin\Content\Comment;
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

        view()->composer('admin.layouts.header',function($view){
            $view->with('unseenComments',Comment::where('seen', 0)->get());


        });
    }
}
