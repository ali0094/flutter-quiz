@extends('layouts.home')

@section('title', 'Add Fund')

@section('content')

    <!--Sub Banner Wrap Start -->
    <div class="gt_sub_banner_bg default_width">
        <div class="container">
            <div class="gt_sub_banner_hdg  default_width">
                <h3>Add Fund</h3>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li><a href="#">Add Fund</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--Sub Banner Wrap End -->

    <!--Main Content Wrap Start-->
    <div class="gt_main_content_wrap">
        <!--About Us Wrap Start-->
        <section class="gt_about_bg">
            <div class="container">


                <div class="row">
                    <div class="col-md-12">
                        <!--  ==================================SESSION MESSAGES==================================  -->
                        @if (session()->has('message'))
                            <div class="alert alert-{!! session()->get('type')  !!} alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!! session()->get('message')  !!}
                            </div>
                        @endif
                    <!--  ==================================SESSION MESSAGES==================================  -->


                        <!--  ==================================VALIDATION ERRORS==================================  -->
                        @if($errors->any())
                            @foreach ($errors->all() as $error)

                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!!  $error !!}
                                </div>

                        @endforeach
                    @endif
                    <!--  ==================================SESSION MESSAGES==================================  -->

                    </div>
                </div>

                <div class="row">

                    @if($paypal->status == 1)

                    <div class="col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading" style="background-color: #019cde; color:#fff;"><strong>ADD FUND
                                    VIA PayPal</strong></div>
                            <div class="panel-body">
                                <img src="{{ asset('images') }}/{{ $paypal->image }}" alt="" class="img-responsive">
                                <br>

                                <form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal">
                                    <input type="hidden" name="cmd" value="_xclick" />
                                    <input type="hidden" name="business" value="{{ $paypal->val1 }}" />
                                    <input type="hidden" name="cbt" value="{{ $title->title }}" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="quantity" value="1" />
                                    <input type="hidden" name="item_name" value="Fund ADD {{ $title->title }}" />

                                    <!-- Custom value you want to send and process back in the IPN -->
                                    <input type="hidden" name="custom" value="{{ $log->custom }}" />

                                    <input type="hidden" name="return" value="{{ route('home') }}"/>
                                    <input type="hidden" name="cancel_return" value="{{ url()->current() }}" />

                                    <!-- Where to send the PayPal IPN to. -->
                                    <input type="hidden" name="notify_url" value="{{ route('paypal-ipn') }}" />

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">ADD</span>
                                            <input class="form-control input-lg" placeholder="AMOUNT"
                                                   name="amount" type="text" required="">
                                            <span class="input-group-addon">USD</span>
                                        </div>
                                    </div>

                                    <input type="submit" name="PAYMENT_METHOD" value="ADD VIA PAYPAL!"
                                           class="btn btn-lg btn-block" style="background-color: #019cde; color: #fff;">

                                </form>

                            </div>
                        </div>
                    </div>
                    @endif
                        @if($perfect->status == 1)

                            <div class="col-md-3">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="background-color: #019cde; color:#fff;"><strong>ADD
                                            VIA Perfect Money</strong></div>
                                    <div class="panel-body">
                                        <img src="{{ asset('images') }}/{{ $perfect->image }}" alt="" class="img-responsive">
                                        <br>

                                        <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="myform">
                                            <input type="hidden" name="PAYEE_ACCOUNT" value="{{ $perfect->val1 }}">
                                            <input type="hidden" name="PAYEE_NAME" value="{{ $title->title }}">
                                            <input type='hidden' name='PAYMENT_ID' value="{{ $log->custom }}">
                                            <input type="hidden" name="PAYMENT_UNITS" value="USD">
                                            <input type="hidden" name="STATUS_URL" value="{{ route('perfect-ipn') }}">
                                            <input type="hidden" name="PAYMENT_URL" value="{{ route('home') }}">
                                            <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">
                                            <input type="hidden" name="NOPAYMENT_URL" value="{{ url()->current() }}">
                                            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">
                                            <input type="hidden" name="SUGGESTED_MEMO" value="{{ $title->title }}">
                                            <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT">

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">ADD</span>
                                                    <input class="form-control input-lg" placeholder="AMOUNT"
                                                           name="PAYMENT_AMOUNT" type="text" required="">
                                                    <span class="input-group-addon">USD</span>
                                                </div>
                                            </div>
                                            <input type="submit" name="PAYMENT_METHOD" value="ADD PERFECT MONEY!"
                                                   class="btn btn-lg btn-block" style="background-color: #019cde; color: #fff;">

                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($btc->status == 1)

                            <div class="col-md-3">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="background-color: #019cde; color:#fff;"><strong>ADD
                                            VIA BTC - BlockChain</strong></div>
                                    <div class="panel-body">
                                        <img src="{{ asset('images') }}/{{ $btc->image }}" alt="" class="img-responsive">
                                        <br>

                                        {!! Form::open(['route'=>'btc-preview']) !!}


                                        <input type="hidden" name="custom" value="{{ $log->custom }}">
                                        <input type="hidden" name="member_id" value="{{ $log->member_id }}">
                                        <input type="hidden" name="url" value="{{ url()->current() }}">

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">ADD</span>
                                                    <input class="form-control input-lg" placeholder="AMOUNT"
                                                           name="amount" type="text" required="">
                                                    <span class="input-group-addon">USD</span>
                                                </div>
                                            </div>

                                            <input type="submit" name="PAYMENT_METHOD" value="ADD VIA BTC"
                                                   class="btn btn-lg btn-block" style="background-color: #019cde; color: #fff;">

                                        {{ Form::close() }}


                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($stripe->status == 1)

                            <div class="col-md-3">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="background-color: #019cde; color:#fff;"><strong>ADD
                                            VIA Perfect Money</strong></div>
                                    <div class="panel-body">
                                        <img src="{{ asset('images') }}/{{ $stripe->image }}" alt="" class="img-responsive">
                                        <br>

                                        {!! Form::open(['route'=>'stripe-preview']) !!}
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">ADD</span>
                                                <input class="form-control input-lg" placeholder="AMOUNT"
                                                       name="amount" type="text" required="">
                                                <span class="input-group-addon">USD</span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="custom" value="{{ $log->custom }}">
                                        <input type="hidden" name="member_id" value="{{ $log->member_id }}">
                                        <input type="hidden" name="url" value="{{ url()->current() }}">
                                        <input type="submit" name="PAYMENT_METHOD" value="ADD VIA CREDIT CARD"
                                               class="btn btn-lg btn-block" style="background-color: #019cde; color: #fff;">
                                        {{ Form::close() }}


                                    </div>
                                </div>
                            </div>
                        @endif

                </div>
            </div>
        </section>
        <!--About Us Wrap End-->

    </div>
    <!--Main Content Wrap End-->


@endsection