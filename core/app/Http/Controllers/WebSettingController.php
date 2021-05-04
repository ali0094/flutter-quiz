<?php

namespace App\Http\Controllers;

use App\AboutUs;
use App\Contact;
use App\Exam;
use App\Footer;
use App\History;
use App\Logo;
use App\Offer;
use App\Partner;
use App\Question;
use App\Slider;
use App\SocialIcon;
use App\SubCategory;
use App\Title;
use Illuminate\Http\Request;
use App\Payment;

use App\Http\Requests;
use Session;
use Image;
use Storage;

class WebSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $data = [];
    }

    public function getLogo()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        return view('websetting.logo',$data);
    }
    public function postLogo(Request $request, $id)
    {
        $logo = Logo::findOrFail($id);
        $this->validate($request, [
           'name' => 'required|mimes:png|dimensions:max_width=225,max_height=60'
        ]);
        if($request->hasFile('name')){
            $image = $request->file('name');
            $filename = "logo".'.'.$image->getClientOriginalExtension();
            $location = 'images/' . $filename;
            Image::make($image)->save($location);
            $logo->name = $filename;
            $logo->save();
        }

        Session::flash('success', 'Successfully Image Uploaded.');

        return redirect()->route('logo');
    }
    public function getTitle()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $title = Title::first();
        return view('websetting.title',$data)->withTitle($title);
    }

    public function postTitle(Request $request, $id)
    {
        $title = Title::findOrFail($id);
        $this->validate($request, [
           'title' => 'required'
        ]);
        $title->title = $request->input('title');
        $title->save();
        Session::flash('success', 'Successfully Web Title Updated.');
        $title = Title::first();
        return redirect()->route('title')->withTitle($title);
    }
    public function getFooter()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $footer = Footer::first();
        return view('websetting.footer',$data)->withFooter($footer);
    }
    public function postFooter(Request $request, $id)
    {
        $footer = Footer::findOrFail($id);
        $this->validate($request, [
           'left_footer' => 'required',
            'right_footer' => 'required',
            'about_footer' => 'required'
        ]);
        $footer->left_footer = $request->input('left_footer');
        $footer->right_footer = $request->input('right_footer');
        $footer->about_footer = $request->input('about_footer');

        $footer->save();
        Session::flash('success', 'Successfully Footer Updated');
        $footer = Footer::all();
        return redirect()->route('footer')->withFooter($footer);
    }

    public function getSlider()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $slider = Slider::all();
        return view('websetting.slider',$data)->withSlider($slider);
    }
    public function postSlider(Request $request)
    {
        $slider = new Slider;
        $this->validate($request, [
            'name' => 'required|mimes:jpg,jpeg,png',
            'bold_text' => 'required',
            'small_text' =>'required'
        ]);
        if($request->hasFile('name')){
            $image = $request->file('name');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'extra-images/' . $filename;
            Image::make($image)->resize(1920,750)->save($location);
            $slider->name = $filename;
            $slider->bold_text = $request->bold_text;
            $slider->small_text = $request->small_text;
            $slider->save();
        }

        Session::flash('success', 'Successfully Slider Saved.');

        return redirect()->route('slider');
    }

    public function deleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        Storage::delete($slider->name);
        Session::flash('success', 'Successfully Slider Deleted.');
        $slider->delete();
        $slider = Slider::all();
        return redirect()->route('slider')->withSlider($slider);
    }

    public function getOffer()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;

        $offer = Offer::first();
        return view('websetting.offer',$data)->withOffer($offer);
    }
    public function putOffer(Request $request, $id)
    {
        $this->validate($request, [
           'title' => 'required',
            'description' => 'required'
        ]);

        $offer = Offer::findOrFail($id);
        $offer->title = $request->input('title');
        $offer->description = $request->input('description');
        $offer->save();
        $noffer = Offer::findorFail($id);
        Session::flash('success', 'Successfully Offers Updated');
        return redirect()->route('offer')->withOffer($noffer);
    }

    public function getHistory()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $data['category'] = SubCategory::all()->count();
        $data['exam'] = Exam::all()->count();
        $data['question']= Question::all()->count();
        return view('websetting.history',$data);
    }


    public function getPartner()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $partner = Partner::all();
        return view('websetting.partner',$data)->withPartner($partner);
    }
    public function postPartner(Request $request)
    {
        $partner = new Partner;
        $this->validate($request, [
           'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|dimensions:max_width=160,max_height=125'
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'extra-images/' . $filename;
            Image::make($image)->save($location);
            $partner->image = $filename;
            $partner->name = $request->name;

            $partner->save();
        }

        Session::flash('success', 'Successfully partner Added');
        $partner = Partner::all();
        return redirect()->route('partner')->withPartner($partner);

    }
    public function deletePartner($id)
    {

        $partner = Partner::findOrFail($id);
        $partner->delete();
        Storage::delete($partner->image);

        Session::flash('success', 'Successfully Partner Deleted');
        $partner = Partner::all();
        return redirect()->route('partner')->withPartner($partner);
    }
    public function getPayment()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $payment = Payment::first();
        return view('websetting.payment',$data)->withPayment($payment);
    }
    public function putPayment(Request $request, $id)
    {
        $this->validate($request,[
           'email' => 'required',
            'uid' => 'required',
            'code' => 'required'
        ]);
        $payment = Payment::first();
        $payment->email = $request->input('email');
        $payment->uid = $request->input('uid');
        $payment->code = $request->input('code');

        $payment->save();
        Session::flash('success', 'Successfully Payment Setting updated.');
        $payment = Payment::first();
        return redirect()->route('payment')->withPayment($payment);
    }

    public function getSocial()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $social = SocialIcon::first();
        return view('websetting.social',$data)->withSocial($social);
    }

    public function putSocial(Request $request, $id)
    {
        $link = SocialIcon::findOrFail($id);
        $this->validate($request,[
           'facebook' => 'required',
           'twitter' => 'required',
           'googleplus' => 'required',
           'linkedin' => 'required',
           'youtube' => 'required'
        ]);
        $link->twitter = $request->input('twitter');
        $link->google_plus = $request->input('googleplus');
        $link->linkedin = $request->input('linkedin');
        $link->youtube = $request->input('youtube');
        $link->facebook = $request->input('facebook');

        $link->save();
        Session::flash('success', 'Successfully Link Updated.');
        $social = SocialIcon::findOrFail($id);

        return redirect()->route('social')->withSocial($social);
    }

    public function getContact()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $contact = Contact::first();
        return view('websetting.contact',$data)->withContact($contact);
    }
    public function putContact(Request $request, $id)
    {
        $this->validate($request, [
            'number' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        $contact = Contact::findOrFail($id);
        $contact->number = $request->number;
        $contact->email = $request->email;
        $contact->address = $request->address;

        $contact->save();

        Session::flash('success', 'Successfully Contact Updated');
        $contactall = Contact::first();
        return redirect()->route('contact')->withContact($contactall);

    }
    public function getAbout()
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $about = AboutUs::first();
        return view('websetting.aboutus',$data)->withAbout($about);
    }
    public function putAbout(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $about = AboutUs::findOrFail($id);
        $about->name = $request->name;
        $about->description = $request->description;

        $about->save();

        Session::flash('success', 'Successfully About Updated');
        $about= AboutUs::first();
        return redirect()->route('aboutus')->withAbout($about);

    }




}
