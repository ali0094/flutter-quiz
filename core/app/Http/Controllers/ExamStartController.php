<?php

namespace App\Http\Controllers;

use DB;

use App\Exam;
use App\Question;
use App\SubCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Contact;
use App\Logo;
use App\Partner;
use App\SocialIcon;
use Illuminate\Support\Facades\Auth;
use App\Title;
use App\Footer;

use App\Currency;
use App\User;

class ExamStartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function getExamStart($id)
    {

        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $sponsor = Partner::all();
        $exam_category = SubCategory::orderBy('id', 'ASC')->get();
        $singleexam = SubCategory::findOrFail($id);
        $catname = $singleexam->name;
        $title = Title::first();
        $footer = Footer::first();
        $curr = Currency::all();
        Session::put('exam_cat', $id);
        $question = Question::where('question_cat_name', '=', $catname)->get();
        $numQ = Question::where('question_cat_name', '=', $singleexam->id)->count();
        return view('examstart.examstart')->withSingleexam($singleexam)
            ->withSocial($social)
            ->withContact($contact)
            ->withPartner($sponsor)
            ->withCurrency($curr)
            ->withCategory($exam_category)
            ->withLogo($logo)
            ->withSingleexam($singleexam)
            ->withQuestion($question)
            ->withTitle($title)
            ->withFooter($footer)
            ->withNumq($numQ);
    }


    public function getExamConfirm($id)
    {


        $examDetails = SubCategory::findOrFail($id);
        $data = [];

        $data['singleexam'] = $examDetails;
        $data['social'] = SocialIcon::first();
        $data['contact'] = Contact::first();
        $data['logo'] = Logo::first();
        $data['category'] = SubCategory::orderBy('id', 'ASC')->get();
        $title = Title::first();
        $footer = Footer::first();
        $numQ = Question::where('question_cat_name', '=', $examDetails->id)->count();
        if($numQ == 0){
            $data['message'] = "Sorry..! This Category No Questions are Available Now.";
            return view('examstart.skipexam', $data)->withTitle($title)
                ->withFooter($footer);
        }
        else{
            $data['num_Q'] = $numQ;

            $balance = Auth::guard('user')->user()->balance;
            $cost = $examDetails->price;
            $curr = $examDetails->currency;
            $currencyDetails = Currency::where('id', '=', $curr)->first();
            $usdCost = $cost / $currencyDetails->rate;
            $stm = time();
            $etm = time() + $examDetails->time + 10;


            if ($balance < $usdCost) {
                $data['message'] = "YOU DON'T HAVE ENOUGH BANALCE TO TAKE THIS EXAM <br> PLEASE ADD FUND TO YOUR ACCOUNT";

                $data['minfo'] = "";
            } else {

                $newBal = $balance - $usdCost;

// $pro= User::findOrFail(Auth::guard('user')->user()->id);
// $up['balance'] = $newBal;
// $update = $pro->fill($up)->save();


//---------------->>>>>>>>CUT THE BALANCE

                DB::table('users')
                    ->where('id', Auth::guard('user')->user()->id)
                    ->update(['balance' => $newBal]);

//---------------->>>>>>>>CUT THE BALANCE


//---------------->>>>>>>>UPDATE OTHER EXAMS

                DB::table('exams')
                    ->where('user_id', Auth::guard('user')->user()->id)
                    ->update(['status' => 0]);

//---------------->>>>>>>>UPDATE OTHER EXAMS


                $exam = new Exam;
                $exam->user_id = Auth::guard('user')->user()->id;
                $exam->category_id = $id;
                $exam->start_time = $stm;
                $exam->end_time = $etm;
                $exam->save();

                $data['message'] = "$usdCost USD Deducted From your Account. Current Balance is $newBal USD";
                $data['minfo'] = "Please Do Not Refresh The Page. YOUR EXAM WILL START IN

          <b id=\"note\"> 10 SECONDS</b>


        <meta http-equiv=\"refresh\" content=\"9; url=../examineMe/$id\" />

          ";

            }


            return view('examstart.examconfirm', $data)->withTitle($title)
                ->withFooter($footer);
        }

    }


    public function LestStartExam($id)
    {

        $examDetails = SubCategory::findOrFail($id);
        $data = [];

        $data['singleexam'] = $examDetails;
        $data['social'] = SocialIcon::first();
        $data['contact'] = Contact::first();
        $data['logo'] = Logo::first();
        $data['title'] = Title::first();
        $data['footer'] = Footer::first();
        $data['category'] = SubCategory::orderBy('id', 'ASC')->get();
        $data['num_Q'] = Question::where('question_cat_name', '=', $examDetails->id)->count();

        $data['question'] = Question::where('question_cat_name', '=', $examDetails->id)->get();


        $okay = Exam::where('user_id', Auth::guard('user')->user()->id)->where('category_id', $id)->where('status', 1)->count();


        if ($okay == 0) {
            return redirect()->back();
        } else {
            $data['question'] = Question::where('question_cat_name', '=', $examDetails->id)->get();
        }

        $examStats = Exam::where('user_id', Auth::guard('user')->user()->id)->where('category_id', $id)->where('status', 1)->first();


        $data['tmleft'] = $examStats->end_time - time();


        return view('examstart.leststart', $data);
    }


    public function FinishExam($id)
    {

        $examDetails = SubCategory::findOrFail($id);
        $numQ = Question::where('question_cat_name', '=', $examDetails->id)->count();

        $data = [];

        $data['singleexam'] = $examDetails;
        $data['social'] = SocialIcon::first();
        $data['contact'] = Contact::first();
        $data['logo'] = Logo::first();
        $data['title'] = Title::first();
        $data['footer'] = Footer::first();
        $data['category'] = SubCategory::orderBy('id', 'ASC')->get();


        $okay = Exam::where('user_id', Auth::guard('user')->user()->id)->where('category_id', $id)->where('status', 1)->count();


        if ($okay == 0) {
            return redirect()->back();
        } else {

//////////--------------------------->>>>>>>>>>>>>>
            $examStats = Exam::where('user_id', Auth::guard('user')->user()->id)->where('category_id', $id)->where('status', 1)->first();


            if ($examStats->end_time < time()) {
                $data['message'] = "TIME FINISHED! <br> No Evaluation For This!";
            } else {

                $data['message'] = "You Have Successfully Finish The Exam";


                $count = 0;
                $ra = 0;
                $wa = 0;

                foreach ($_POST as $key => $val) {
                    if ($key != '_token') {
                        $qq = Question::where('id', '=', $key)->first();

                        if ($val == $qq->answer) {
                            $ra++;
                        } else {
                            $wa++;
                        }

                        $count++;
                    }

                }


                $perc = round(($ra / $numQ) * 100);

                $resu = "Total Question: $numQ , Answered: $count , Right Answer: $ra , Mark Obtained: $perc %";

                $data['num_Q'] = $numQ;
                $data['ans_Q'] = $count;
                $data['ra_Q'] = $ra;
                $data['wa_Q'] = $wa;
                $data['score_Q'] = $perc;


//---------------->>>>>>>>UPDATE EXAMS

                DB::table('exams')
                    ->where('user_id', Auth::guard('user')->user()->id)
                    ->where('category_id', $id)
                    ->where('status', 1)
                    ->update(['status' => 0, 'result' => $resu]);

//---------------->>>>>>>>UPDATE EXAMS


                $data['message'] = "You Have Successfully Finish The Exam";


            }


        }


        $data['tmleft'] = $examStats->end_time - time();


        return view('examstart.finish', $data);
    }


}
