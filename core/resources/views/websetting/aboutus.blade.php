@extends('layouts.layout')

@section('title', 'Manage Logo')

@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Manage About Us
                <small></small>
            </h3>
            <!-- END PAGE TITLE-->

            <hr>


            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">

                        <div class="portlet-body form">


                            <div class="panel-heading">Manage About Us</div>
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
                                {!! Form::model($about,['route'=>['about_update',$about->id],'method'=>'PUT']) !!}
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <h3 style="margin-top:0px">Title : </h3>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="name" id="" value="{{ $about->name }}" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <h3 style="margin-top:10px">About Us Description : </h3>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea style="margin-top:20px" name="description" id="" cols="30" rows="10" class="form-control" class="form-control" required>{{ $about->description }}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-md-9 col-md-offset-3">
                                            <div class="form-group" style="margin-top: 10px">

                                                {!! Form::submit('Update About Us', ['class'=>'btn btn-primary btn-block btn-lg margin-top-20']) !!}

                                            </div>
                                        </div>


                                    </div>
                                </div>
                                {!! Form::close() !!}

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