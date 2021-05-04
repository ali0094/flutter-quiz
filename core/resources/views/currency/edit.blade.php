@extends('layouts.layout')

@section('title', 'Create New Currency')

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
                    <a href="#">Manage Currency</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Edit Currency</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> 
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(Session::has('success'))
                    <div class="alert alert-info">
                        <strong>Success : </strong>{{ Session::get('success') }}
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-pencil-square"></i> EDIT Currency</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($currency,['route'=>['currency.update',$currency->id],'method'=>'PUT']) !!}










<div class="row">
<div class="form-group">
<label class="col-md-3 control-label"><strong class="pull-right">Currency : </strong></label>
<div class="col-md-6">
    <input type="text" class="form-control input-lg" name="name" value="{{ $currency->name }}" placeholder="Currency Name" required>
</div>
</div>
</div>
<br>
<div class="row">
<div class="form-group">
<label class="col-md-3 control-label"><strong class="pull-right">Conversion Rate : </strong></label>
<div class="col-md-6">
    <input type="text" class="form-control input-lg" name="rate" value="{{ $currency->rate }}" placeholder="1 USD = How Much?" required>
</div>
</div>
</div>




<div class="row">
<div class="col-md-6 col-md-offset-3  margin-top-20">
<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-paper-plane" aria-hidden="true"></i> Update Currency</button>
</div>
</div>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->


@endsection