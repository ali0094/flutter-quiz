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
                            <div class="panel-heading" style="background-color: #019cde; color:#fff;"><strong>BTC - BlockChain Fund Add Preview</strong></div>
                            <div class="panel-body">

                                <h4 style="text-align: center; text-transform: uppercase;"> SEND EXACTLY <strong>{{ $btc }} BTC </strong> TO <strong>{{ $add }}</strong><br>
                                    {!! $code !!} <br>
                                    <strong>SCAN TO SEND</strong> <br><br>
                                    <strong style="color: red;">NB: 3 Confirmation required to Credited your Account</strong>
                                </h4>

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