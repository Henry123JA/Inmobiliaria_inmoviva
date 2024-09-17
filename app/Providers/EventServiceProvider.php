<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Listeners\LogUserRegistered;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\MarcaCreated;
use App\Events\MarcaUpdated;
use App\Events\ModeloCreated;
use App\Events\ModeloUpdated;
use App\Events\ArticuloCreated;
use App\Events\ArticuloUpdated;
use App\Listeners\LogMarcaCreated;
use App\Listeners\LogMarcaUpdated;
use App\Listeners\LogModeloCreated;
use App\Listeners\LogModeloUpdated;
use App\Listeners\LogArticuloCreated;
use App\Listeners\LogArticuloUpdated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            LogUserRegistered::class,
        ],
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        Logout::class => [
            LogSuccessfulLogout::class,
        ],
        MarcaCreated::class => [
            LogMarcaCreated::class,
        ],
        MarcaUpdated::class => [
            LogMarcaUpdated::class,
        ],
        ModeloCreated::class => [
            LogModeloCreated::class,
        ],
        ModeloUpdated::class => [
            LogModeloUpdated::class,
        ],
        ArticuloCreated::class => [
            LogArticuloCreated::class,
        ],
        ArticuloUpdated::class => [
            LogArticuloUpdated::class,
        ],
        'App\Events\MarcaViewed' => [
        'App\Listeners\LogMarcaViewed',
        ],
        'App\Events\ArticuloViewed' => [
        'App\Listeners\LogArticuloViewed',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
