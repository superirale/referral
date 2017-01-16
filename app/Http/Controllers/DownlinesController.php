<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserDownline;
use Auth;
use Session;
use P2P\Assign;

class DownlinesController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->p2p = new Assign;
	}

    public function index()
    {
    	$user = User::select('name')->find(Auth::user()->id)->toArray();
    	$downlines = $this->p2p->getDownlineTree(Auth::user()->id);
    	$user['children'] = $downlines;
    	$downlines = $user;
    	$downline_page = 1;
    	return view('downlines.index', compact('downline_page', 'downlines'));
    }
}
