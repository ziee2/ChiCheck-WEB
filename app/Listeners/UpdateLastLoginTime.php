<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLastLoginTime
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */

    public function handle(Login $event): void
    {
        $event->user->update([
            'terakhir_login' => now(),
        ]);
    }
}


