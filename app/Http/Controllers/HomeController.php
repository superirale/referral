<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Donation;
use P2P\Assign;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p2p = new Assign();

        $total_received = Donation::where('payee_user_id', Auth::user()->id)
                                        ->where('status', 'approved')
                                        ->sum('amount');
        $total_donated = Donation::where('payer_user_id', Auth::user()->id)
                                        ->where('status', 'approved')
                                        ->sum('amount');

        $next_level = isset(Auth::user()->userLevel->level)? intval(Auth::user()->userLevel->level->level_no) + 1: 1;

        $next_level_amt = $p2p->amountToPay($next_level);
        $upline = $p2p->getUpline(Auth::user()->id, 1, $next_level);

        return view('home', compact('total_donated', 'total_received', 'next_level', 'next_level_amt', 'upline'));
    }
}
