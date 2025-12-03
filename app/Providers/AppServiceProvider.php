<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\MataKuliah;

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
       
        
    // Custom route binding: hanya ambil mata kuliah milik user login
    Route::bind('mataKuliah', function ($value) {
        return MataKuliah::where('id', $value)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    });
    
    }
}
