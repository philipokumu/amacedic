<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Events\PaidOrderEvent;
use App\Events\AssignedOrderEvent;
use App\Events\InprogressOrderEvent;
use App\Events\UnassignedOrderEvent;
use App\Events\IneditingOrderEvent;
use App\Events\CompletedOrderEvent;
use App\Events\InrevisionOrderEvent;
use App\Events\ApprovedOrderEvent;
use App\Events\CancelledOrderEvent;
use App\Events\ReassignedOrderEvent;
use App\Events\MessageAdminEvent;
use App\Events\MessageUserEvent;
use App\Events\MessageEditorEvent;
use App\Events\MessageWriterEvent;
use App\Events\NewsUserEvent;
use App\Events\NewsEditorEvent;
use App\Events\NewsWriterEvent;
use App\Listeners\PaidOrderListener;
use App\Listeners\AssignedOrderListener;
use App\Listeners\InprogressOrderListener;
use App\Listeners\UnassignedOrderListener;
use App\Listeners\IneditingOrderListener;
use App\Listeners\CompletedOrderListener;
use App\Listeners\InrevisionOrderListener;
use App\Listeners\ApprovedOrderListener;
use App\Listeners\CancelledOrderListener;
use App\Listeners\ReassignedOrderListener;
use App\Listeners\MessageAdminListener;
use App\Listeners\MessageEditorListener;
use App\Listeners\MessageWriterListener;
use App\Listeners\MessageUserListener;
use App\Listeners\NewsEditorListener;
use App\Listeners\NewsWriterListener;
use App\Listeners\NewsUserListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PaidOrderEvent::class => [
            PaidOrderListener::class,
        ],  
        AssignedOrderEvent::class => [
            AssignedOrderListener::class,
        ],
        InprogressOrderEvent::class => [
            InprogressOrderListener::class,
        ],
        UnassignedOrderEvent::class => [
            UnassignedOrderListener::class,
        ],
        IneditingOrderEvent::class => [
            IneditingOrderListener::class,
        ],
        CompletedOrderEvent::class => [
            CompletedOrderListener::class,
        ],  
        InrevisionOrderEvent::class => [
            InrevisionOrderListener::class,
        ],     
        ApprovedOrderEvent::class => [
            ApprovedOrderListener::class,
        ],  
        CancelledOrderEvent::class => [
            CancelledOrderListener::class,
        ],  
        ReassignedOrderEvent::class => [
            ReassignedOrderListener::class,
        ],
        MessageAdminEvent::class => [
            MessageAdminListener::class,
        ],
        MessageUserEvent::class => [
            MessageUserListener::class,
        ], 
        MessageEditorEvent::class => [
            MessageEditorListener::class,
        ],
        MessageWriterEvent::class => [
            MessageWriterListener::class,
        ],
        NewsUserEvent::class => [
            NewsUserListener::class,
        ], 
        NewsEditorEvent::class => [
            NewsEditorListener::class,
        ],
        NewsWriterEvent::class => [
            NewsWriterListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
