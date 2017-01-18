<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Bank;
use App\BankDetail;
use App\AccountType;
use Illuminate\Http\Request;
use Session;
use Auth;

class BankDetailController extends Controller
{
    public function __construct()
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
        $bankdetail = BankDetail::paginate(25);
        $banks = Bank::pluck('name', 'id');

        return view('bank-detail.index', compact('bankdetail', 'banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('bank-detail.create');
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


        BankDetail::create($requestData);

        Session::flash('flash_message', 'BankDetail added!');

        return redirect("bank-detail/".$requestData['user_id']."/edit");
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
        $bankdetail = BankDetail::findOrFail($id);

        return view('bank-detail.show', compact('bankdetail'));
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
        $bankdetail = BankDetail::where('user_id', $id)->first();
        $banks = Bank::pluck('name', 'id');
        $account_types = AccountType::pluck('name', 'id');

        if(!$bankdetail)
            return view('bank-detail.create', compact('bankdetail', 'banks', 'account_types'));

        return view('bank-detail.edit', compact('bankdetail', 'banks', 'account_types'));
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

        $bankdetail = BankDetail::findOrFail($id);
        $bankdetail->update($requestData);

        Session::flash('flash_message', 'BankDetail updated!');

        return redirect("bank-detail/".Auth::user()->id."/edit");
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
        BankDetail::destroy($id);

        Session::flash('flash_message', 'BankDetail deleted!');

        return redirect('bank-detail');
    }
}
