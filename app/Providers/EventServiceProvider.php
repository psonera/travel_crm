<?php

namespace App\Providers;

use App\Events\ActivityCreated;
use App\Events\ActivityModified;
use App\Events\AssignLead;
use App\Events\NewLead;
use App\Events\TransferOfLeads;
use App\Listeners\ActivityCreatedListener;
use App\Listeners\ActivityModifiedListener;
use App\Listeners\AssignLeadListener;
use App\Listeners\NewLeadListener;
use App\Listeners\TransferOfLeadsListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ActivityCreated::class => [
            ActivityCreatedListener::class
        ],
        ActivityModified::class => [
            ActivityModifiedListener::class
        ],
        NewLead::class => [
            NewLeadListener::class
        ],
        AssignLead::class => [
            AssignLeadListener::class
        ],
        TransferOfLeads::class => [
            TransferOfLeadsListener::class
        ]
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

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
