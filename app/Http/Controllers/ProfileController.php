<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use App\User;
use App\City;
use Illuminate\Http\Request;
use Session;
use Auth;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $profile = Profile::paginate(25);
        $cities = City::all();

        return view('profile.index', compact('profile', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = City::pluck('id', 'name');

        return view('profile.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();
        $requestData['user_id'] = Auth::user()->id;

        Profile::create($requestData);

        Session::flash('flash_message', 'Profile added!');

        return redirect("profile/".$requestData['user_id']."/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        $cities = City::pluck('id', 'name');

        return view('profile.show', compact('profile', 'cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($user_id)
    {
        $profile = Profile::where('user_id', $user_id)->first();

        $cities = City::pluck('name', 'id');

        if(!$profile)
            return view('profile.create', compact('cities', 'profile'));

        return view('profile.edit', compact('profile', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $profile = Profile::findOrFail($id);
        $profile->update($requestData);

        Session::flash('flash_message', 'Profile updated!');
        $user = Auth::user()->id;

        return redirect("profile/".Auth::user()->id."/edit");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Profile::destroy($id);

        Session::flash('flash_message', 'Profile deleted!');

        return redirect('profile');
    }

    public function changePassword(Request $request)
    {
        if($request->isMethod('post')){

            //check if the old password is correct
            //and validate if the new password is the same with conf-password
            //

        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $request->old_password])){
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8'
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $new_password = bcrypt($request->password);
            $user->update(['password' => $new_password]);

            Session::flash('flash_message', 'Pasword Changed!');

            }

            Session::flash('flash_message', 'Pasword not changed!');

        }

        return view('profile.password');
    }
}