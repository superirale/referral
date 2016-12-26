<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\UserDownline;
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
                    ->where('users.status', 'verified')
                    ->where('users.id', "!=", $event->data->id)
                    ->orderBy('users.created_at', 'desc')
                    ->first();

        if(!isset($user->id)){
            $user = DB::select("select * from users u  inner
                                join user_downlines ud ON u.id = ud.user_id
                                where ud.user_id is not null and
                                ud.level = 1
                                group by ud.id
                                having count(ud.id) < 5
                                order by count(ud.id), u.created_at asc Limit 1");
            $user = $user[0];
        }

        //give new user a topline
        UserDownline::create([
                'user_id' => $user->id,
                'downline_user_id' => $event->data->id,
                'level' => 1,
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
