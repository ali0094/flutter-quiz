@extends('layouts.layout')

@section('title', 'Manage Logo')

@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Manage Partner
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
                                <div class="panel-heading">Manage Partner</div>
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
                                    {!! Form::open(['route'=>'partner_post','method'=>'POST','files'=>true]) !!}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="previous-logo">
                                                <h3>Partner Name : </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="previous-logo" style="margin-top: 20px">
                                                <input type="text" name="name" id="" class="form-control"required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="previous-logo">
                                                <h3>Partner Logo : </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="previous-logo" style="margin-top: 20px">
                                                <input type="file" name="image" id="" class="form-control"required>
                                                <p style="margin-left: 10px"><b>Note : </b>Image Must be JPG & PNG Format
                                                    <br>Dimensions : 160px X 125px</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                            {!! Form::submit('Add New Partner', ['class'=>'btn btn-primary btn-block btn-lg margin-top-20']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    <hr>

                                </div>{{--panel body--}}
                            </div>{{--end col--}}
                        </div> {{--//end Row--}}

                        <div class="row">
                            @foreach($partner as $p)

                                <div class="col-md-3">
                                    <div class="img">
                                        <img title="{{ $p->name }}" src="{{ asset('extra-images') }}/{{ $p->image }}" alt="" style="width: 160px; height: 125; margin-top: 20px">
                                    </div>

                                    {!! Form::open(['route'=>['partner_delete',$p->id],'method'=>'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are You Sure..!')"><i class="fa fa-trash"></i> Delete Partner</button>
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