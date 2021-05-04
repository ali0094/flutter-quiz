@extends('layouts.layout')

@section('title', 'Manage Favicon')

@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Manage Favicon
                <small></small>
            </h3>
            <!-- END PAGE TITLE-->

            <hr>


            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">

                        <div class="portlet-body form">


                            <div class="panel-heading">Manage Favicon</div>
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
                                    <div class="col-md-6">
                                        <div class="previous-logo">
                                            <h3>Current Favicon : </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="previous-logo">
                                            <img src="{{ asset('images/favicon.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::open(['route'=>['favicon_post',1],'method'=>'PUT', 'files'=>true]) !!}

                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <h3 style="margin-top:0px">New Favicon : </h3>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="image" id="" class="form-control" required>
                                                <p style="margin-left: 10px"><b>Note : </b>Image Must be PNG. <br>Max: 60px X 60px</p>
                                            </div>

                                        </div>
                                        <div class="form-group" style="padding-top: 0px">

                                            {!! Form::submit('Change Favicon', ['class'=>'btn btn-primary btn-block btn-lg margin-top-20']) !!}

                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>

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