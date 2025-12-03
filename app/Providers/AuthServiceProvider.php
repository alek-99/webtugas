<?php

namespace App\Providers;

use App\Models\Tugas;
use App\Policies\TugasPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

     protected $policies = [
        Tugas::class => TugasPolicy::class,
    ];
    public function boot(): void
    {
        //
    }
}
