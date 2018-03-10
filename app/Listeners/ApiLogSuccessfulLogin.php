<?php

namespace App\Listeners;

use App\Events\ApiLoginEvent;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApiLogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ApiLoginEvent  $event
     * @return void
     */
    public function handle(ApiLoginEvent $event)
    {
        $event->user->last_logon = Carbon::now()->toDateTimeString();
        $event->user->save();
    }
}
