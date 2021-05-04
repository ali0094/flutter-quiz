<?php

namespace App\Http\Controllers;

use App\AboutUs;
use App\Contact;
use App\Currency;
use App\Footer;
use App\History;
use App\Logo;
use App\Offer;
use App\Partner;
use App\PasswordSubmit;
use App\PaymentLog;
use App\PaymentMethod;
use App\Slider;
use App\SocialIcon;
use App\SubCategory;
use App\Title;
use App\User;
use Illuminate\Http\Request;
use App\Exam;
use App\Question;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;

class HomeController extends Controller
{
    public function getHomePage()
    {
        $data = [];
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $slider = Slider::all();
        $offer = Offer::first();
        $sponsor = Partner::all();
        $title = Title::first();
        $footer = Footer::first();
        $data['subcategory'] = SubCategory::all()->count();
        $data['exam'] = Exam::all()->count();
        $data['question']= Question::all()->count();
        $data['currency'] = Currency::all();
        $exam_category = SubCategory::orderBy('id', 'DESC')->get();
        return view('home.home',$data)
            ->withSocial($social)
            ->withContact($contact)
            ->withSliders($slider)
            ->withOffer($offer)
            ->withPartner($sponsor)
            ->withCategory($exam_category)
            ->withLogo($logo)
            ->withTitle($title)
            ->withFooter($footer);
    }

    public function getAboutUs()
    {
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $sponsor = Partner::all();
        $exam_category = SubCategory::orderBy('id', 'DESC')->get();
        $about = AboutUs::first();
        $title = Title::first();
        $footer = Footer::first();
        return view('home.aboutus')
            ->withSocial($social)
            ->withContact($contact)
            ->withPartner($sponsor)
            ->withCategory($exam_category)
            ->withLogo($logo)
            ->withAbout($about)
            ->withTitle($title)
            ->withFooter($footer);
    }
    public function getContactUs()
    {
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $sponsor = Partner::all();
        $exam_category = SubCategory::orderBy('id', 'DESC')->get();
        $title = Title::first();
        $footer = Footer::first();
        return view('home.contactus')
            ->withSocial($social)
            ->withContact($contact)
            ->withPartner($sponsor)
            ->withCategory($exam_category)
            ->withLogo($logo)
            ->withTitle($title)
            ->withFooter($footer);
    }
    public function getForgetPassword()
    {
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $sponsor = Partner::all();
        $title = Title::first();
        $footer = Footer::first();
        $exam_category = SubCategory::orderBy('id', 'DESC')->get();
        return view('user.reset-password')
            ->withSocial($social)
            ->withContact($contact)
            ->withPartner($sponsor)
            ->withCategory($exam_category)
            ->withLogo($logo)
            ->withTitle($title)
            ->withFooter($footer);
    }
    public function submitForgetPassword(Request $request)
    {
        $email = $request->email;
        $ur = User::whereEmail($email)->count();
        $user = User::whereEmail($email)->first();
        if ($ur == 1){
            $data['token'] = Str::random(60);
            $data['email'] = $email;
            $data['status'] = 0;
            $rr = PasswordSubmit::create($data);
            $url = route('user-password-reset',$rr->token);

            $contact = Contact::first();
            $title = Title::first();
            $footer = Footer::first();
            $mail_val = [
                'email' => $user->email,
                'name' => $user->lname.' '.$user->fname,
                'g_email' => $contact->email,
                'g_title' => $title->title,
                'subject' => 'Password Reset',
            ];
            Config::set('mail.driver','mail');
            Config::set('mail.from',$contact->email);
            Config::set('mail.name',$title->title);

            Mail::send('auth.reset-email', ['name' => $user->name,'link'=>$url,'footer'=>$footer->left_footer], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });

            session()->flash('message', 'Check Your Email.Reset link Successfully send.');
            Session::flash('type', 'success');
            return redirect()->back();

        }else{
            session()->flash('message', 'Email Not Match our Recorded.');
            Session::flash('type', 'warning');
            return redirect()->back();
        }
    }
    public function resetForgetPassword($token)
    {
        $pw = PasswordSubmit::whereToken($token)->count();
        if ($pw != null) {

            $logo = Logo::first();
            $social = SocialIcon::first();
            $contact = Contact::first();
            $sponsor = Partner::all();
            $title = Title::first();
            $footer = Footer::first();

            $exam_category = SubCategory::orderBy('id', 'DESC')->get();
            return view('user.reset-password-form')
                ->withSocial($social)
                ->withContact($contact)
                ->withPartner($sponsor)
                ->withCategory($exam_category)
                ->withLogo($logo)
                ->withTitle($title)
                ->withFooter($footer)
                ->withToken($token);
        }else{
            session()->flash('message', 'Something Is Error..');
            Session::flash('type', 'warning');
            return redirect()->route('user-forget-password');
        }
    }
    public function ResetSubmitPassword(Request $request)
    {
        $this->validate($request,[
            'email' => 'email|required',
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        $pw = PasswordSubmit::whereEmail($request->email)->whereToken($request->token)->count();
        $pw1 = PasswordSubmit::whereEmail($request->email)->whereToken($request->token)->first();
        if ($pw == 1){

            $user = User::whereEmail($pw1->email)->first();
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            PasswordSubmit::whereEmail($pw1->email)->delete();
            session()->flash('message', 'Password Reset Successfully.');
            Session::flash('type', 'success');
            return redirect()->route('userlogin');
        }else{
            session()->flash('message', 'Something Is Error.');
            Session::flash('type', 'success');
            return redirect()->back();
        }
    }
    public function paypalIpn()
    {

        $payment_type		=	$_POST['payment_type'];
        $payment_date		=	$_POST['payment_date'];
        $payment_status		=	$_POST['payment_status'];
        $address_status		=	$_POST['address_status'];
        $payer_status		=	$_POST['payer_status'];
        $first_name			=	$_POST['first_name'];
        $last_name			=	$_POST['last_name'];
        $payer_email		=	$_POST['payer_email'];
        $payer_id			=	$_POST['payer_id'];
        $address_country	=	$_POST['address_country'];
        $address_country_code	=	$_POST['address_country_code'];
        $address_zip		=	$_POST['address_zip'];
        $address_state		=	$_POST['address_state'];
        $address_city		=	$_POST['address_city'];
        $address_street		=	$_POST['address_street'];
        $business			=	$_POST['business'];
        $receiver_email		=	$_POST['receiver_email'];
        $receiver_id		=	$_POST['receiver_id'];
        $residence_country	=	$_POST['residence_country'];
        $item_name			=	$_POST['item_name'];
        $item_number		=	$_POST['item_number'];
        $quantity			=	$_POST['quantity'];
        $shipping			=	$_POST['shipping'];
        $tax				=	$_POST['tax'];
        $mc_currency		=	$_POST['mc_currency'];
        $mc_fee				=	$_POST['mc_fee'];
        $mc_gross			=	$_POST['mc_gross'];
        $mc_gross_1			=	$_POST['mc_gross_1'];
        $txn_id				=	$_POST['txn_id'];
        $notify_version		=	$_POST['notify_version'];
        $custom				=	$_POST['custom'];

        $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);

        $paypal = PaymentMethod::whereId(1)->first();

        $paypal_email = $paypal->val1;

        if($payer_status=="verified" && $payment_status=="Completed" && $receiver_email==$paypal_email && $ip=="notify.paypal.com"){

            $data = PaymentLog::where('custom' , $custom)->first();

            $user = User::findOrFail($data->member_id);
            $user->balance = $user->balance + $mc_gross;
            $user->save();
            $data->status = 1;
            $data->save();
            return redirect()->back();

        }

    }
    public function perfectIPN()
    {
        $pay = PaymentMethod::whereId(2)->first();
        $passphrase=strtoupper(md5($pay->val2));

        define('ALTERNATE_PHRASE_HASH',  $passphrase);
        define('PATH_TO_LOG',  '/somewhere/out/of/document_root/');
        $string=
            $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
            $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
            $_POST['PAYMENT_BATCH_NUM'].':'.
            $_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
            $_POST['TIMESTAMPGMT'];

        $hash=strtoupper(md5($string));
        $hash2 = $_POST['V2_HASH'];

        if($hash==$hash2){

            $amo = $_POST['PAYMENT_AMOUNT'];
            $unit = $_POST['PAYMENT_UNITS'];
            $custom = $_POST['PAYMENT_ID'];


            $data = PaymentLog::where('custom' , $custom)->first();

            if($_POST['PAYEE_ACCOUNT']=="$pay->val1" && $unit=="USD"){

                $user = User::findOrFail($data->member_id);
                $user->balance = $user->balance + $amo;
                $user->save();
                $data->status = 1;
                $data->save();
                return redirect()->back();

            }else{
                session()->flash('message', 'Something error....');
                Session::flash('type', 'warning');
                return redirect()->back();
            }
        }
    }
    public function btcPreview(Request $request)
    {
        $data['amount'] = $request->amount;
        $data['custom'] = $request->custom;
        $data['url'] = $request->url;
        $pay = PaymentMethod::whereId(3)->first();
        $tran = PaymentLog::whereCustom($data['custom'])->first();
        $blockchain_root = "https://blockchain.info/";
        $blockchain_receive_root = "https://api.blockchain.info/";
        $mysite_root = url('/');
        $secret = "ABIR";
        $my_xpub = $pay->val2;
        $my_api_key = $pay->val1;

        $invoice_id = $tran->custom;


        $callback_url = route('btc_ipn',['invoice_id'=>$invoice_id,'secret'=>$secret]);

        if ($tran->btc_acc == null){
            if (file_exists($blockchain_receive_root . "v2/receive?key=" . $my_api_key . '&callback=' . urlencode($callback_url) . '&xpub=' . $my_xpub)) {
                $resp = file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . '&callback=' . urlencode($callback_url) . '&xpub=' . $my_xpub);
    
                $response = json_decode($resp);
        
                $sendto = $response->address;
        
                $api = "https://blockchain.info/tobtc?currency=USD&value=".$data['amount'];
        
                $usd = file_get_contents($api);
                $tran->amount = $request->amount;
                $tran->btc_amo = $usd;
                $tran->btc_acc = $sendto;
                $tran->save();
            }else{
                session()->flash('message', 'BlockChain Something Error.');
                Session::flash('type', 'warning');
                return redirect()->back();
            }

    
        }else{
            $usd = $tran->btc_amo;
            $sendto = $tran->btc_acc;
        }

        $var = "bitcoin:$sendto?amount=$usd";
        $data['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";
        $data['amount'] = $request->amount;
        $data['custom'] = $request->custom;
        $data['url'] = $request->url;
        $data['btc'] = $usd;
        $data['add'] = $sendto;
        $data['logo'] = Logo::first();
        $data['social'] = SocialIcon::first();
        $data['contact'] = Contact::first();
        $data['sponsor'] = Partner::all();
        $data['exam_category'] = SubCategory::orderBy('id', 'DESC')->get();
        $data['about'] = AboutUs::first();
        $data['title'] = Title::first();
        $data['footer'] = Footer::first();
        $data['category'] = SubCategory::all();
        $data['title'] = Title::first();
        return view('fund.btc-preview',$data);
    }
    public function btcIPN($invoice_id,$secret){
        $depoistTrack = $_GET['invoice_id'];
        $secret = $_GET['secret'];
        $address = $_GET['address'];
        $value = $_GET['value'];
        $confirmations = $_GET['confirmations'];
        $value_in_btc = $_GET['value'] / 100000000;

        $trx_hash = $_GET['transaction_hash'];

        $DepositData = PaymentLog::whereCustom($depoistTrack)->first();

        if ($DepositData->btc_amo == $value_in_btc && $DepositData->btc_acc == $address && $secret=="ABIR" && $confirmations>2){

            $user = User::findOrFail($DepositData->member_id);
            $user->balance = $user->balance + $DepositData->amount;
            $user->save();
            $DepositData->status = 1;
            $DepositData->save();
            return redirect()->back();

        }
    }
    public function stripePreview(Request $request)
    {
        $data['logo'] = Logo::first();
        $data['social'] = SocialIcon::first();
        $data['contact'] = Contact::first();
        $data['sponsor'] = Partner::all();
        $data['exam_category'] = SubCategory::orderBy('id', 'DESC')->get();
        $data['about'] = AboutUs::first();
        $data['title'] = Title::first();
        $data['footer'] = Footer::first();
        $data['category'] = SubCategory::all();
        $data['title'] = Title::first();;
        $data['amount'] = $request->amount;
        $data['custom'] = $request->custom;
        $data['url'] = $request->url;
        return view('fund.stripe-preview',$data);
    }
    public function submitStripe(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required',
            'custom' => 'required',
            'cardNumber' => 'required|numeric',
            'cardExpiryMonth' => 'required|numeric',
            'cardExpiryYear' => 'required|numeric',
            'cardCVC' => 'required|numeric',
        ]);
        $data = PaymentLog::whereCustom($request->custom)->first();
        $amm = $request->amount;
        $cc = $request->cardNumber;
        $emo = $request->cardExpiryMonth;
        $eyr = $request->cardExpiryYear;
        $cvc = $request->cardCVC;
        $basic = PaymentMethod::whereId(4)->first();
        Stripe::setApiKey($basic->val1);
        try{
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $emo,
                    "exp_year" => $eyr,
                    "cvc" => "$cvc"
                )
            ));
            if (!isset($token['id'])) {
                session()->flash('message','The Stripe Token was not generated correctly');
                return Redirect::to($request->url);
            }

            $charge = Charge::create(array(
                'card' => $token['id'],
                'currency' => 'USD',
                'amount' => round($request->amount) * 100,
                'description' => 'item',
            ));

            if ($charge['status'] == 'succeeded' ) {

                $user = User::findOrFail($data->member_id);
                $user->balance = $user->balance + $charge['amount'] / 100;
                $user->save();
                $data->status = 1;
                $data->save();

                session()->flash('message','Card Successfully Charged.');
                session()->flash('title','Success');
                session()->flash('type','success');
                return Redirect::to($request->url);
            }else{
                session()->flash('message','Something Is Wrong.');
                session()->flash('title','Opps..');
                session()->flash('type','warning');
                return Redirect::to($request->url);
            }

        }catch (\Exception $e){
            session()->flash('message',$e->getMessage());
            session()->flash('title','Opps..');
            session()->flash('type','warning');
            return Redirect::to($request->url);
        }
    }




}
