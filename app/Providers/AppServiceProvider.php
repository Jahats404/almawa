<?php

namespace App\Providers;

use App\Models\Agen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.assets.sidebar', function ($view) {
            $diterima = Agen::where('status', 'Diterima')
                            ->where('user_id', Auth::id())
                            ->first();
            $view->with('diterima', $diterima);
        });
    }
}