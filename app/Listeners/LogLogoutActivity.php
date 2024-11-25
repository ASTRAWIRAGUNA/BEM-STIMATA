<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogLogoutActivity
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
    public function handle(Logout $event): void
    {
        //  // Pastikan user adalah instance model Eloquent
        //  $user = $event->user;

        //  if ($user instanceof \Illuminate\Contracts\Auth\Authenticatable) {
        //      $user = app(\App\Models\User::class)->find($user->getAuthIdentifier());
        //  }
 
        //  // Log activity setelah memastikan user valid
        //  if ($user) {
        //      activity()
        //          ->causedBy($user)
        //          ->log('User logged out');
        //  }
         Log::info('Logout event triggered for User ID: ' . $event->user->getAuthIdentifier());

         $user = app(\App\Models\User::class)->find($event->user->getAuthIdentifier());

        if ($user) {
        Log::info('User successfully cast to model: ' . $user->nim);

        activity()
            ->causedBy($user)
            ->tap(function ($activity) {
                $activity->log_name = 'logout_activity'; // Nama log
                 })
            ->withProperties(['role' => $user->role])
            ->log("{$user->role} logged out");
        } else {
        Log::warning('User casting failed on logout.');
        }
     
    }
}
