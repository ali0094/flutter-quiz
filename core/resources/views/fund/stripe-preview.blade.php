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

                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading" style="background-color: #019cde; color:#fff;"><strong>Fund Add via Credit Card </strong></div>
                            <div class="panel-body">

                                <form role="form" method="POST" action="{{ route('stripe-submit') }}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="custom" value="{{ $custom }}">
                                    <input type="hidden" name="url" value="{{ $url }}">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="cardNumber">CARD NUMBER</label>
                                                <div class="input-group">
                                                    <input
                                                            type="tel"
                                                            class="form-control input-lg"
                                                            name="cardNumber"
                                                            placeholder="Valid Card Number"
                                                            autocomplete="off"
                                                            required autofocus
                                                    />
                                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-xs-4 col-md-4">
                                            <div class="form-group">
                                                <label for="cardExpiry"><span class="hidden-xs">EXP MONTH</span></label>
                                                <input
                                                        type="tel"
                                                        class="form-control input-lg"
                                                        name="cardExpiryMonth"
                                                        placeholder="MM"
                                                        autocomplete="off"
                                                        required
                                                />
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <div class="form-group">
                                                <label for="cardExpiry"><span class="hidden-xs">EXP YEAR</span></label>
                                                <input
                                                        type="tel"
                                                        class="form-control input-lg"
                                                        name="cardExpiryYear"
                                                        placeholder="YYYY"
                                                        autocomplete="off"
                                                        required
                                                />
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-4 pull-right">
                                            <div class="form-group">
                                                <label for="cardCVC">CV CODE</label>
                                                <input
                                                        type="tel"
                                                        class="form-control input-lg"
                                                        name="cardCVC"
                                                        placeholder="CVC"
                                                        autocomplete="off"
                                                        required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="subscribe btn btn-success btn-lg btn-block" type="submit">Payment Now</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--About Us Wrap End-->

    </div>
    <!--Main Content Wrap End-->


@endsection