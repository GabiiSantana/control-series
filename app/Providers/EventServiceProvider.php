<?php

namespace App\Providers;

use App\Events\SeriesCreated;
use App\Listeners\EmailUsersAboutSeriesCreated;
use App\Listeners\LogSeriesCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {
    /**
     * Register services.
     */

    protected array $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // Sempre que essa série for criada essa classe será executada
        SeriesCreated::class => [
            EmailUsersAboutSeriesCreated::class,
            LogSeriesCreated::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
