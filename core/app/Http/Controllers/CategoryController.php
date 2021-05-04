<?php

namespace App\Http\Controllers;

use App\Category;
use App\Title;
use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
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
        $category = Category::orderBy('id','DESC')->paginate(5);
        return view('category.index',$data)->withCategory($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        if($request->ajax()){
            $category = Category::create($request->input());

            return response()->json($category);
        }
        else{
            $category = Category::create($request->input());

            return redirect()->refresh();
        }
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
        $category = Category::find($id);
        return view('category.edit',$data)->withCategory($category);
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
        $this->validate($request,[
           'name' => 'required',
            'description' => 'required'
        ]);


        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');



        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index');
    }



}
