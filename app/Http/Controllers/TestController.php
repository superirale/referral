<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\UserDownline;
use Carbon\Carbon;
use DB;
class TestController extends Controller
{

	function index()
	{


		$deletedRows = User::where('status', "unverified")
								->whereRaw("DATE_ADD(created_at, INTERVAL 24 HOUR) <= CURRENT_DATE()")
								->delete();


		$incompleted_downline_users = collect(DB::select("select u.*, count(u.id) as countx from users u
					                                inner join user_downlines ud ON u.id = ud.user_id
					                                where ud.user_id is not null
					                                and ud.stage = 1
					                                group by u.id
					                                having countx < 5
					                                order by count(ud.id), u.created_at asc"));


		 $users_without_upline = User::selectRaw('users.id ,users.name')->leftjoin('user_downlines', 'users.id', "=", 'user_downlines.downline_user_id')
                    ->where('users.id', "!=", 1)
                    ->whereNull('user_downlines.downline_user_id')
                    ->orderBy('users.created_at', 'asc')
                    ->get();

        foreach ($incompleted_downline_users as $key => $value) {

        	$downline_count = $incompleted_downline_users[$key]->countx;

            if( $users_without_upline->count() > 0 && $downline_count < 5){
            	$needed_downlines = 5 - $downline_count;

                    for ($i=0; $i < $needed_downlines; $i++) {

                        if($downline = $users_without_upline->pop()){
                        	dd($incompleted_downline_users[$key]);
                            $new_downline = UserDownline::create([
                                'user_id' =>  $incompleted_downline_users[$key]->id,
                                'downline_user_id' => $downline->id,
                                'stage' => 1
                            ]);
                        }
                    }

            }
        }

		$users_without_downline = $user = User::selectRaw('users.id ,users.name')->leftjoin('user_downlines', 'users.id', "=", 'user_downlines.user_id')
                    ->whereNull('user_downlines.user_id')
                    ->orderBy('users.created_at', 'asc')
                    ->get();


        foreach ($users_without_downline as $key => $value) {

        	$downline_count = $users_without_downline[$key]->countx;

            if( $users_without_upline->count() > 0 && $downline_count < 5){
            	$needed_downlines = 5 - $downline_count;

                    for ($i=0; $i < $needed_downlines; $i++) {

                        if($downline = $users_without_upline->pop()){

                            $new_downline = UserDownline::create([
                                'user_id' =>  $users_without_downline[$key]->id,
                                'downline_user_id' => $downline->id,
                                'stage' => 1
                            ]);
                        }
                    }

            }
        }
	}
}