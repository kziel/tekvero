<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        RateLimiter::for('contact', function (Request $request) {
            $maxAttempts = (int) env('CONTACT_RATE_LIMIT', 5);
            $decayMinutes = (int) env('CONTACT_RATE_WINDOW', 1);

            return Limit::perMinutes($decayMinutes, $maxAttempts)->by((string) $request->ip());
        });
    }
}
