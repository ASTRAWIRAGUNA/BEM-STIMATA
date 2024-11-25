<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Login;
use Spatie\Activitylog\Models\Activity;

use Illuminate\Queue\InteractsWithQueue;

class LogLoginActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        Log::info('Login event triggered. User ID: ' . $event->user->getAuthIdentifier());

        $user = app(\App\Models\User::class)->find($event->user->getAuthIdentifier());
    
        if ($user) {
            Log::info('User successfully cast to model: ' . $user->nim);
    
            activity()
            ->causedBy($user)
            ->tap(function ($activity) {
                $activity->log_name = 'auth_activity'; // Nama log
            })
  
            ->withProperties(['role' => $user->role])
            ->log("{$user->role} logged in");
        } else {
            Log::warning('User casting failed.');
        }
    
    }

}
