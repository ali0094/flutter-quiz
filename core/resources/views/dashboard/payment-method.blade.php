@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->

        <!-- END THEME PANEL -->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{ $page_title }}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{ $page_title }}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">

            <div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if($errors->any())
                    @foreach ($errors->all() as $error)

                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!!  $error !!}
                        </div>

                    @endforeach
                @endif

            </div>
            <div class="col-md-12">
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-money"></i>Payment Method</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>

                    <div class="portlet-body" style="overflow: hidden">
                        {!! Form::open(['method'=>'post','files'=>true]) !!}
                        <div class="col-md-6 col-sm-12">
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-paypal"></i>Paypal</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">


                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><i class="fa fa-cc-paypal"></i> PayPal Details</h1>
                                        </div>
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                                <div class="col-md-9">
                                                    <input name="paypal_image" class="form-control" type="file">
                                                    <br>
                                                    <b style="color: red;">Square Size(400X400) JPG image Recommended</b>
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <img src="{{ asset('images') }}/{{ $paypal->image }}" alt="Display Image" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control" name="paypal_name" value="{{ $paypal->name }}" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group" style="margin-top: 40px;margin-bottom: 135px;">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PayPal Business Email</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="paypal_email" value="{{ $paypal->val1 }}" required type="text">
                                                        <span class="input-group-addon"><b>@</b></span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                                <div class="col-md-12">
                                                    <input name="paypal_status" type="checkbox" {{ $paypal->status == 1 ? 'checked' : '' }} class="make-switch" id="test" data-size="large">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-money"></i>Perfect Money </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-credit-card-alt"></i> Perfect Money</strong></h1>
                                        </div>
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                                <div class="col-md-9">
                                                    <input name="perfect_image" class="form-control" type="file">
                                                    <br>
                                                    <b style="color: red;">Square Size(400X400) JPG image Recommended</b>
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <img src="{{ asset('images') }}/{{ $perfect->image }}" alt="Display Image" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control" name="perfect_name" value="{{ $perfect->name }}" required type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Perfect Money USD Account</strong></label>
                                                <div class="col-md-12" style="margin-bottom: 21px;">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="perfect_account" value="{{ $perfect->val1 }}" type="text">
                                                        <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Perfect Money Alternate Passphrase  </strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="perfect_alternate" value="{{ $perfect->val2 }}" type="text">
                                                        <span class="input-group-addon"><i class="fa fa-bolt"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                                <div class="col-md-12">
                                                    <input name="perfect_status" type="checkbox" {{ $perfect->status == 1 ? 'checked' : '' }} class="make-switch" id="test" data-size="large">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-btc"></i>BTC ( BlockChain )</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-btc"></i> BlockChain - (BITCOIN)</strong></h1>
                                        </div>
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                                <div class="col-md-9">
                                                    <input name="btc_image" class="form-control" type="file">
                                                    <br>
                                                    <b style="color: red;">Square Size(400X400) JPG image Recommended</b>
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <img src="{{ asset('images') }}/{{ $btc->image }}" alt="Display Image" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control" name="btc_name" value="{{ $btc->name }}" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin API Key</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btc_api" value="{{ $btc->val1 }}" type="text">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin XPUB Code  </strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btc_xpub" value="{{ $btc->val2 }}" type="text">
                                                        <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                                <div class="col-md-12">

                                                    <input name="btc_status" type="checkbox" {{ $btc->status == 1 ? 'checked' : '' }} class="make-switch" id="test" data-size="large">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-credit-card"></i>Credit Card </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-cc-stripe"></i> Stripe (CARD)</strong></h1>
                                        </div>
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                                <div class="col-md-9">
                                                    <input name="stripe_image" class="form-control" type="file">
                                                    <br>
                                                    <b style="color: red;">Square Size(400X400) JPG image Recommended</b>
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <img src="{{ asset('images') }}/{{ $stripe->image }}" alt="Display Image" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                                <div class="col-md-12">
                                                    <input class="form-control" name="stripe_name" value="{{ $stripe->name }}" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">SECRET KEY</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stripe_secret" value="{{ $stripe->val1 }}" type="text">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PUBLISHER KEY</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stripe_publishable" value="{{ $stripe->val2 }}" type="text">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                                <div class="col-md-12">

                                                    <input name="stripe_status" type="checkbox" {{ $stripe->status == 1 ? 'checked' : '' }} class="make-switch" id="test" data-size="large">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-info btn-block"><i class="fa fa-send"></i> <strong>Save Changes</strong></button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->

    </div>

@endsection
