@extends('layouts.home')

@section('title', 'Exam Skip')

@section('content')

        <!--Sub Banner Wrap Start -->
<div class="gt_sub_banner_bg default_width">
    <div class="container">
        <div class="gt_sub_banner_hdg  default_width">
            <h3>Exam Skip</h3>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Exam Skip</a></li>
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

                <h3 style="text-align: center;">
                    {!! $message !!}
                </h3>

            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-md-4 col-md-offset-2">
                    <a href="{{ route('home') }}" class="btn btn-lg btn-success btn-block">Go Home</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('exam') }}" class="btn btn-lg btn-primary btn-block">Another Exam</a>
                </div>
            </div>

        </div>
    </section>
    <!--About Us Wrap End-->

</div>
<!--Main Content Wrap End-->


@endsection
