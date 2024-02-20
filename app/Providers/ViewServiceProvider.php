<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::guard('employee')->user() ?? Auth::user();
            $view->with('user', $user);
        });
    }
}
