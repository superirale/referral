<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\UserDownline;
use App\UserLevel;
use DB;

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
        $user = User::select("users.id")
                    ->leftjoin('user_downlines', 'users.id', "=", 'user_downlines.user_id')
                    ->whereNull('user_downlines.user_id')
                    // ->where('users.status', 'verified')
                    ->where('users.id', "!=", $event->data->id)
                    ->orderBy('users.created_at', 'asc')
                    ->first();

        if(!isset($user->id)){
            $user = DB::select("select u.*, count(u.id) as countx from users u
                                inner join user_downlines ud ON u.id = ud.user_id
                                where ud.user_id is not null
                                and ud.stage = 1
                                group by u.id
                                having countx < 5
                                order by count(ud.id), u.created_at asc
                                LIMIT 1");
            $user = $user[0];
        }

        // if(!isset()){
        //     $user = DB::select("");
        // }

        //give new user a topline
        UserDownline::create([
            'user_id' => $user->id,
            'downline_user_id' => $event->data->id,
            'stage' => 1,
        ]);

        UserLevel::create([
            'user_id' => $event->data->id,
            'level_id' => 1
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
        $this->onRegistered($event);
    }
}
