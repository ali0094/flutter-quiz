@extends('layouts.layout')

@section('title', 'Manage Logo')

@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Manage Slider
                <small></small>
            </h3>
            <!-- END PAGE TITLE-->

            <hr>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel-heading">Manage Slider</div>
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
                                    {!! Form::open(['route'=>'slider_post','method'=>'POST','files'=>true]) !!}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="previous-logo">
                                                    <h3>New Slider : </h3>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="previous-logo">
                                                    <input type="file" name="name" id="" class="form-control"required>
                                                    <p style="margin-left: 10px"><b>Note : </b>Image will Resize to : 1920px X 750px</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3>Bold Text : </h3>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" style="margin-top: 15px" name="bold_text" id="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3>Small Text : </h3>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" style="margin-top: 15px" name="small_text" id="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2">
                                                {!! Form::submit('Add New Slider', ['class'=>'btn btn-primary btn-block btn-lg margin-top-20']) !!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    <hr>

                                </div>{{--panel body--}}
                            </div>{{--end col--}}
                        </div> {{--//end Row--}}

                        <div class="row">
                            @foreach($slider as $s)

                                <div class="col-md-6">
                                    <div class="img">
                                        <img src="{{ asset('extra-images') }}/{{ $s->name }}" alt="" style="width: 500px; margin-top: 20px">
                                    </div>
                                    <div class="img-text">
                                        <h3><b>{{ $s->bold_text }}</b></h3>
                                        <p>{{ $s->small_text }}</p>
                                    </div>
                                    {!! Form::open(['route'=>['slider_delete',$s->id],'method'=>'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-block btn-lg" onclick="return confirm('Are You Sure..!')"><i class="fa fa-trash"></i> Delete Slider</button>
                                    {!! Form::close() !!}
                                </div>

                            @endforeach

                        </div>

                        <div class="portlet-body form">


                        </div>
                    </div>
                </div>
            </div><!---ROW-->

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

@endsection