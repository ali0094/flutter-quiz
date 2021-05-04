<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Title;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $currency = Currency::orderBy('id','DESC')->paginate(5);
        return view('currency.index',$data)->withCurrency($currency);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        return view('currency.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|unique:currencies,name',
           'rate' => 'required'
        ]);
        $currency = new Currency;
        $currency->name = $request->name;
        $currency->rate = $request->rate;

        $currency->save();

        Session::flash('success','Successfully Currency Added.');

        return redirect()->route('currency.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $currency = Currency::findOrFail($id);
        return view('currency.edit',$data)->withCurrency($currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currencyall = Currency::orderBy('id','DESC')->paginate(5);
        $this->validate($request, [
           'name' => 'required',
           'rate' => 'required'
        ]);
        $currency = Currency::findOrFail($id);
        $currency->name = $request->input('name');
        $currency->rate = $request->input('rate');
        $currency->save();
        Session::flash('success','Successfully Currency Updated.');

        return redirect()->back()->withCurrency($currencyall);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currencyall = Currency::orderBy('id','DESC')->paginate(5);
        $currency = Currency::findOrFail($id);
        $currency->delete();
        Session::flash('success', 'Successfully Currency Deleted');
        return redirect()->route('currency.index')->withCurrency($currencyall);
    }
}
