@extends('layouts.layout')

@section('title', 'Manage History')

@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Manage History
                <small></small>
            </h3>
            <!-- END PAGE TITLE-->

            <hr>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">

                        <div class="portlet-body form">


                            <div class="panel-heading">View History</div>
                            <div class="panel-body">

                                @if(Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        <strong>Message : </strong>{!! Session::get('success') !!}
                                    </div>
                                @endif
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error: </strong>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <h4>Exam Total Category : </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{ $category }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <h4>Total Question : </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{ $question }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <h4>Total Exam : </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{ $exam }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                {{--{!! Form::model($history,['route'=>['history_update',$history->id],'method'=>'PUT']) !!}
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <h3 style="margin-top:0px">History Title : </h3>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="title" id="" value="{{ $history->title }}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-top: 10px">
                                            <div class="col-md-4">
                                                <h3 style="margin-top:10px">First History : </h3>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="first" value="{{ $history->category_title }}" class="form-control" required id="">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="first_value" value="{{ $history->category }}" class="form-control" required id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-top: 10px">
                                            <div class="col-md-4">
                                                <h3 style="margin-top:10px">Second History : </h3>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="second" value="{{ $history->question_title }}" class="form-control" required id="">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="second_value" value="{{ $history->question }}" class="form-control" required id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-top: 10px">
                                            <div class="col-md-4">
                                                <h3 style="margin-top:10px">Third History : </h3>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="third" value="{{ $history->exam_title }}" class="form-control" required id="">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="third_value" value="{{ $history->exam }}" class="form-control" required id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-8 col-md-offset-4">
                                            <div class="form-group" style="margin-top: 10px">

                                                {!! Form::submit('Update History', ['class'=>'btn btn-primary btn-block btn-lg margin-top-20']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}--}}

                            </div>
                        </div>
                    </div>
                </div>
            </div><!---ROW-->

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

@endsection