<?php

namespace App\Listeners;

use App\Events\AuthenticationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\PermissionService;

class AuthenticationListener
{
    /**
     * Create the event listener.
     */
    public function __construct(protected PermissionService $service)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuthenticationEvent $event): void
    {
        $this->service->loadPermissions($event->data);
    }
}
