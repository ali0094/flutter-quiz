@extends('layouts.layout')

@section('title', 'Manage Social')

@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Manage Social Link
                <small></small>
            </h3>
            <!-- END PAGE TITLE-->

            <hr>


            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">

                        <div class="portlet-body form">


                            <div class="panel-heading">Manage Socials</div>
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
                                {!! Form::model($social,['route'=>['social_update',$social->id],'method'=>'PUT']) !!}
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <h3 style="margin-top:0px">Facebook <i class="fa fa-facebook-square" aria-hidden="true"></i> : </h3>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="facebook" id="" value="{{ $social->facebook }}" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 10px">

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <h3 style="margin-top:0px">Twitter <i class="fa fa-twitter-square" aria-hidden="true"></i> : </h3>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="twitter" id="" value="{{ $social->twitter }}" class="form-control" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 10px">

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <h3 style="margin-top:0px">Google Plus <i class="fa fa-google-plus-square" aria-hidden="true"></i> : </h3>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="googleplus" id="" value="{{ $social->google_plus }}" class="form-control" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 10px">

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <h3 style="margin-top:0px">Linkedin <i class="fa fa-linkedin-square" aria-hidden="true"></i> : </h3>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="linkedin" id="" value="{{ $social->linkedin }}" class="form-control" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 10px">

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <h3 style="margin-top:0px">Youtube <i class="fa fa-youtube-square" aria-hidden="true"></i> : </h3>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="youtube" id="" value="{{ $social->youtube }}" class="form-control" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-8 col-md-offset-4">
                                            <div class="form-group" style="margin-top: 10px">

                                                {!! Form::submit('Update Links', ['class'=>'btn btn-primary btn-block btn-lg margin-top-20']) !!}

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