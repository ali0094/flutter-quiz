<?php

namespace App\Http\Controllers;

use App\Footer;
use App\Title;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use App\History;
use App\Logo;
use App\Offer;
use App\Partner;
use App\Slider;
use App\SocialIcon;
use App\SubCategory;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function __construct()
    {

    }

    public function getLogin()
{
    $logo = Logo::first();
    $social = SocialIcon::first();
    $contact = Contact::first();
    $sponsor = Partner::all();
    $title = Title::first();
    $footer = Footer::first();
    $exam_category = SubCategory::orderBy('id', 'DESC')->get();
    return view('user.login')
        ->withSocial($social)
        ->withContact($contact)
        ->withPartner($sponsor)
        ->withCategory($exam_category)
        ->withLogo($logo)
        ->withTitle($title)
        ->withFooter($footer);
}
    public function postLogin(Request $request)
    {

        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])){

            // Authentication passed...
            Session::flash('success', 'Log In Successfully');
            $id = Session::get('exam_cat');
            Session::put('user','user');
            if($id != null){
                return redirect()->route('exam_start',$id);
            }
            else{
                return redirect()->route('exam');
            }
        }

        $request->session()->flash('message', 'Login incorrect!');
        return redirect()->back();
    }

    public function getRegister()
    {
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $title = Title::first();
        $footer = Footer::first();
        $sponsor = Partner::all();
        $exam_category = SubCategory::orderBy('id', 'ASC')->get();
        return view('user.login')
            ->withSocial($social)
            ->withContact($contact)
            ->withPartner($sponsor)
            ->withCategory($exam_category)
            ->withLogo($logo)
            ->withTitle($title)
            ->withFooter($footer);
    }
    public function postRegister(Request $request)
    {
        $this->validate($request,[
           'name' => 'required|min:5',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $reg = new User;
        $password = Hash::make($request->password_confirmation);
        $reg->name = $request->name;
        $reg->email = $request->email;
        $reg->password = $password;

        $reg->save();
        Session::flash('success', 'Your Registration Successfully Complected.');

        return redirect()->route('userlogin');
    }
    public function logout()
    {
        Auth::guard('user')->logout();
        session()->forget('user');
        session()->forget('exam_cat');
        session()->flash('success', 'Successfully Logged Out!');
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $sponsor = Partner::all();
        $title = Title::first();
        $footer = Footer::first();
        $exam_category = SubCategory::orderBy('id', 'DESC')->get();
        return redirect()->route('userlogin')
            ->withSocial($social)
            ->withContact($contact)
            ->withPartner($sponsor)
            ->withCategory($exam_category)
            ->withTitle($title)
            ->withFooter($footer)
            ->withLogo($logo);
    }


}
