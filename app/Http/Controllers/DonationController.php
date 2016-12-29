<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Donation;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;
use App\BankAccount;
use App\Helpers\Uploader;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $donation = Donation::paginate(25);

        return view('donation.index', compact('donation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('donation.create');
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
        $this->validate($request, [
			'donated_to' => 'required',
			'amount' => 'required',
			'payment_details' => 'required',
            'payee_user_id' => 'required'
		]);

        $requestData = $request->all();
        $requestData['payer_user_id'] = Auth::user()->id;

        $donation = Donation::create($requestData);

        $uploader = new Uploader();

        if($request->hasFile("payment_receipt")){

            $main_dir = env("PAYMENT_RECEIPT_DIR");
            $upload_dir = $uploader->getUploadDir($donation->id, $main_dir);

            $extension = $request->payment_receipt->extension();
            $filename = uniqid().$donation->id.'.'.$extension;
            $new_filename = $upload_dir.'/'. $filename;

            $upload = $uploader->upload($request->payment_receipt, $new_filename, '');

            $donation->payment_receipt = $filename;
            $donation->save();
        }

        Session::flash('flash_message', 'Donation added!');

        return redirect('donation');
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
        $donation = Donation::findOrFail($id);

        return view('donation.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $donation = Donation::findOrFail($id);

        return view('donation.edit', compact('donation'));
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
        $this->validate($request, [
			'donated_to' => 'required',
			'amount' => 'required',
			'payment_details' => 'required'
		]);
        $requestData = $request->all();

        $donation = Donation::findOrFail($id);
        $donation->update($requestData);

        Session::flash('flash_message', 'Donation updated!');

        return redirect('donation');
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
        Donation::destroy($id);

        Session::flash('flash_message', 'Donation deleted!');

        return redirect('donation');
    }

    public function recieved()
    {
        $received_donations = Donation::with(['level', 'sender'=> function ($q)
        {
            $q->with(['bankAccount']);
        }])->where('payee_user_id', Auth::user()->id)->get();

        $current_user = User::with(['bankAccount' => function ($q)
        {
            $q->with('bank');
        }])->find(Auth::user()->id);

        return view('donation.receive', compact('received_donations', 'current_user'));
    }

    public function sent()
    {
        $sent_donations = Donation::with(['level', 'receiver'=> function ($q)
        {
            $q->with(['bankAccount']);
        }])->where('payer_user_id', Auth::user()->id)->get();

        $current_user = User::with(['bankAccount' => function ($q)
        {
            $q->with('bank');
        }])->find(Auth::user()->id);

        return view('donation.receive', compact('sent_donations', 'current_user'));
    }
}
