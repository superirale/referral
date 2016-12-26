<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\UserDownline;

class AssignDownline
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

    public function onRegistered($event)
    {
        $users = User::join('user_downlines', 'user.id', "=", 'useruser_downlines_downline.user_id')
                    ->whereNull('user_downlines.user_id')
                    ->orderBy('user.created_at', 'desc')
                    ->first();

        if(!$users){
            $users = User::join('user_downlines', 'user.id', "=", 'useruser_downlines_downline.user_id')
                    ->whereNotNull('user_downlines.user_id')
                    ->havingRaw('count(user_downlines.user_id) < 5')
                    ->orderBy('user.created_at', 'desc')
                    ->first();

        }

        //give new user a topline
        UserDownline::create([
                'user_id' => $user->id,
                'downline_user_id' => 1,
            ]);

    }
    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        //
    }
}
