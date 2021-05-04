@extends('layouts.layout')

@section('title', 'Create Exam Question')

@section('content')

    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Manage Question</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Create Question</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Create Exam Question
            <small> under Sub Category</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success ..! </strong> {{ Session::get('success') }}
                    </div>
                @elseif(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="tect-center"><strong>Error ..! </strong> You have Something Error.</h4>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li><p style="color: red">{!! $error !!}</p></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-plus-circle"></i> Create New Question</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>['question_store',$scat->id]]) !!}

                        <div class="form-group">
                            <label for="exampleInputName2"><h4>Exam Category: </h4></label>
                            <select name="question_cat_name" id="" class="form-control" required>

                                @foreach($allscat as $c)
                                    @if($c->id == $scat->name)
                                        <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                    @else
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName2"><h4>Question : </h4></label>
                            <input type="text" class="form-control" id="exampleInputName2" name="question" value="" placeholder="Question" required>
                        </div>

                        <div class="row">
                            <div class="form-group">

                                <div class="col-md-10">
                                    <label for="exampleInputEmail2"><h4>First Option :</h4></label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="first_option" value="" placeholder="First Option" required>
                                </div>
                                <div class="col-md-2">
                                    <label for=""><h4>Answer</h4></label>
                                    <div class="radio" style="margin-top: -5px!important; margin-right: 30px!important;">
                                        <label>
                                            <input type="radio" class="form-control" name="answer" id="" value="first">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">

                                <div class="col-md-10">
                                    <label for="exampleInputEmail2"><h4>Second Option :</h4></label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="second_option" value="" placeholder="Second Option" required>
                                </div>
                                <div class="col-md-2">
                                    <label for=""><h4>Answer</h4></label>
                                    <div class="radio" style="margin-top: -5px!important; margin-right: 30px!important;">
                                        <label>
                                            <input type="radio" class="form-control" name="answer" id="" value="second">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">

                                <div class="col-md-10">
                                    <label for="exampleInputEmail2"><h4>Third Option :</h4></label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="third_option" value="" placeholder="Third Option">
                                </div>
                                <div class="col-md-2">
                                    <label for=""><h4>Answer</h4></label>
                                    <div class="radio" style="margin-top: -5px!important; margin-right: 30px!important;">
                                        <label>
                                            <input type="radio" class="form-control" name="answer" id="" value="third">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">

                                <div class="col-md-10">
                                    <label for="exampleInputEmail2"><h4>Fourth Option :</h4></label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="fourth_option" value="" placeholder="Fourth Option">
                                </div>
                                <div class="col-md-2">
                                    <label for=""><h4>Answer</h4></label>
                                    <div class="radio" style="margin-top: -5px!important; margin-right: 30px!important;">
                                        <label>
                                            <input type="radio" class="form-control" name="answer" id="" value="fourth">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">

                                <div class="col-md-10">
                                    <label for="exampleInputEmail2"><h4>Fifth Option :</h4></label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="fifth_option" value="" placeholder="Fifth Option">
                                </div>
                                <div class="col-md-2">
                                    <label for=""><h4>Answer</h4></label>
                                    <div class="radio" style="margin-top: -5px!important; margin-right: 30px!important;">
                                        <label>
                                            <input type="radio" class="form-control" name="answer" id="" value="fifth">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-4 margin-top-20">
                                <a href="{{ route('question_view',$scat->id) }}" class="btn btn-success btn-block btn-lg"><i class="fa fa-eye"></i> View All Question</a>
                            </div>
                            <div class="col-sm-6  margin-top-20">
                                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save Question</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                <div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->

@endsection