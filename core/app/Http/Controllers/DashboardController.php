<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Favicon;
use App\PaymentMethod;
use App\Question;
use App\SubCategory;
use App\Title;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    /*
     * Get Dashboard Here
     *
     * */
    public function getDashboard()
    {
        $data = [];
        $title = Title::first();
        $data['site_title'] = $title->title;
        $data['question'] = Question::all()->count();
        $data['user'] = User::all()->count();
        $data['category'] = SubCategory::all()->count();
        $data['exam'] = Exam::all()->count();
        return view('dashboard.dashboard',$data);
    }

    public function getPaymentMethod()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $data['page_title'] = "Payment Method";
        $data['paypal'] = PaymentMethod::whereId(1)->first();
        $data['perfect'] = PaymentMethod::whereId(2)->first();
        $data['btc'] = PaymentMethod::whereId(3)->first();
        $data['stripe'] = PaymentMethod::whereId(4)->first();
        return view('dashboard.payment-method',$data);
    }
    public function updatePaymentMethod(Request $request)
    {

        $this->validate($request,[
            'paypal_name' => 'required',
            'paypal_image' => 'mimes:png,jpeg,jpg',
            'paypal_email' => 'required',
            'perfect_name' => 'required',
            'perfect_image' => 'mimes:png,jpeg,jpg',
            'perfect_account' => 'required',
            'perfect_alternate' => 'required',
            'btc_name' => 'required',
            'btc_image' => 'mimes:png,jpeg,jpg',
            'btc_api' => 'required',
            'btc_xpub' => 'required',
            'stripe_name' => 'required',
            'stripe_image' => 'mimes:png,jpeg,jpg',
            'stripe_secret' => 'required',
            'stripe_publishable' => 'required',
        ]);

        $paypal = PaymentMethod::whereId(1)->first();
        $perfect = PaymentMethod::whereId(2)->first();
        $btc = PaymentMethod::whereId(3)->first();
        $stripe = PaymentMethod::whereId(4)->first();

        $paypal->name = $request->paypal_name;
        $paypal->val1 = $request->paypal_email;
        $paypal->status = $request->paypal_status == 'on' ? '1' : '0';
        if($request->hasFile('paypal_image')){
            $image3 = $request->file('paypal_image');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $paypal->image = $filename3;
        }

        $perfect->name = $request->perfect_name;
        $perfect->val1 = $request->perfect_account;
        $perfect->val2 = $request->perfect_alternate;
        $perfect->status = $request->perfect_status == 'on' ? '1' : '0';
        if($request->hasFile('perfect_image')){
            $image3 = $request->file('perfect_image');
            $filename3 = time().'h4'.'.'.$image3->getClientOriginalExtension();
            $location = 'images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $perfect->image = $filename3;
        }

        $btc->name = $request->btc_name;
        $btc->val1 = $request->btc_api;
        $btc->val2 = $request->btc_xpub;
        $btc->status = $request->btc_status == 'on' ? '1' : '0';
        if($request->hasFile('btc_image')){
            $image3 = $request->file('btc_image');
            $filename3 = time().'h5'.'.'.$image3->getClientOriginalExtension();
            $location = 'images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $btc->image = $filename3;
        }

        $stripe->name = $request->stripe_name;
        $stripe->val1 = $request->stripe_secret;
        $stripe->val2 = $request->stripe_publishable;
        $stripe->status = $request->stripe_status == 'on' ? '1' : '0';
        if($request->hasFile('stripe_image')){
            $image3 = $request->file('stripe_image');
            $filename3 = time().'h6'.'.'.$image3->getClientOriginalExtension();
            $location = 'images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $stripe->image = $filename3;
        }

        $paypal->save();
        $perfect->save();
        $btc->save();
        $stripe->save();

        session()->flash('message', 'Payment Method Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();

    }
    public function manageFavicon()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        return view('websetting.favicon',$data);
    }
    public function postFavicon(Request $request,$id)
    {
        $da = Favicon::findOrFail($id);
        $this->validate($request,[
            'image' => 'mimes:png'
        ]);
        $ii = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = "favicon".'.'.$image->getClientOriginalExtension();
            $location = 'images/' . $filename;
            Image::make($image)->resize(60,60)->save($location);
            $ii['favicon'] = $filename;
        }
        $da->fill($ii)->save();
        session()->flash('message', 'Favicon Changes Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();

    }


}
