<?php

namespace App\Http\Controllers;

use App\Question;
use App\SubCategory;
use App\Title;
use Illuminate\Http\Request;

use App\Http\Requests;
use Image;
use Storage;

use Session;

class QuestionController extends Controller
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
        $question = Question::orderBy('id','DESC')->paginate(10);
        $catall = SubCategory::all();
        return view('question.index',$data)->withQuestion($question)->withCatall($catall);
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
        $scat = SubCategory::all();
        return view('question.create',$data)->withScat($scat);
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
         'question' => 'required',
         'question_cat_name' => 'required',
         'first_option' => 'required',
         'second_option' => 'required',
         'answer' => 'required',
         'logo' => 'required'
     ]);
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $filename = md5(uniqid(rand(), true)).'.'.$image->getClientOriginalExtension();
            $location = 'images/' . $filename;
            Image::make($image)->save($location);

        }

        $question = new Question;
        $question->question = $request->question;
        $question->question_cat_name = $request->question_cat_name;
        $question->question_image = $filename;
        $question->first_option = $request->first_option;
        $question->second_option = $request->second_option;
        $question->third_option = $request->third_option;
        $question->fourth_option = $request->fourth_option;
        $question->fifth_option = $request->fifth_option;
        $question->answer = $request->answer;

        $question->save();
        Session::flash('success','Successfully Question Added');

        return redirect()->route('question.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addQuestionById($id)
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $scat = SubCategory::findOrFail($id);
        $allscat = SubCategory::all();
        return view('question.create_category',$data)->withScat($scat)->withAllscat($allscat);
    }

    public function postQuestionById(Request $request,$id)
    {
        $scat = SubCategory::findOrFail($id);
        $allscat = SubCategory::all();

        $this->validate($request, [
            'question' => 'required|unique:questions,question',
            'question_cat_name' => 'required',
            'first_option' => 'required',
            'second_option' => 'required',
            'answer' => 'required'
        ]);

        $question = new Question;
        $question->question = $request->question;
        $question->question_cat_name = $request->question_cat_name;
        $question->first_option = $request->first_option;
        $question->second_option = $request->second_option;
        $question->third_option = $request->third_option;
        $question->fourth_option = $request->fourth_option;
        $question->fifth_option = $request->fifth_option;
        $question->answer = $request->answer;

        $question->save();

        Session::flash('success','Successfully Question Added.');

        return view('question.create_category')->withScat($scat)->withAllscat($allscat);

    }

    public function viewQuestionById($id)
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $scat = SubCategory::findOrFail($id);
        $scatname = $scat->name;
        $scatid = $scat->id;
        $question = Question::where('question_cat_name','=',$scatname)->paginate(10);

        return view('question.view_category',$data)->withQuestions($question)->withScatid($scatid);
    }

    public function showQuestionById($id)
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $question = Question::findOrFail($id);
        $answer = $question->answer;
        if($answer == 'first'){
            $question_answer = $question->first_option;
        }elseif ($answer == 'second'){
            $question_answer = $question->second_option;
        }elseif ($answer == 'third') {
            $question_answer = $question->third_option;
        }elseif ($answer == 'fourth') {
            $question_answer = $question->fourth_option;
        }else{
            $question_answer = $question->fifth_option;
        }

        return view('question.show_question',$data)->withQuestion($question)->withQuestionanswer($question_answer);
    }

    public function editQuestionById($id)
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $question = Question::findOrFail($id);
        $qcat = SubCategory::all();
        return view('question.edit_question',$data)->withQuestion($question)->withQcat($qcat);
    }

    public function updateQuestionById(Request $request, $id)
    {
        $title = Title::first();
        $data['site_title'] = $title->title;
        $question = Question::findOrFail($id);
        $this->validate($request, [
            'question' => 'required',
            'question_cat_name' => 'required',
            'first_option' => 'required',
            'second_option' => 'required',
            'answer' => 'required'
        ]);

        $filename="";
        if($request->hasFile('question_image')){
            $image = $request->file('question_image');
            $filename = md5(uniqid(rand(), true)).'.'.$image->getClientOriginalExtension();
            $location = 'images/' . $filename;
            Image::make($image)->save($location);
        } else{
            if ($request->input('delete') == "1" ) {
                $filename="";
            }
        }


        $question->question = $request->input('question');
        $question->question_cat_name = $request->input('question_cat_name');
        $question->first_option = $request->input('first_option');
        $question->second_option = $request->input('second_option');
        $question->third_option = $request->input('third_option');
        $question->fourth_option = $request->input('fourth_option');
        $question->fifth_option = $request->input('fifth_option');
        $question->answer = $request->input('answer');
        $question->question_image = $filename;
        $question->save();

        $scatname = $request->input('question_cat_name');

        $question = Question::where('question_cat_name','=',$scatname)->paginate(10);


        Session::flash('success','Successfully Question Updated.');

        return view('question.view_category',$data)->withQuestions($question)->withScatid($id);
    }

    public function deleteQuestionById($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        Session::flash('success','Successfully Question Delete');

        return redirect()->route('question.index');
    }

}
