@extends('layouts.home')

@section('title', 'Exam Start')

@section('content')

        <!--Sub Banner Wrap Start -->
<div class="gt_sub_banner_bg default_width">
    <div class="container">
        <div class="gt_sub_banner_hdg  default_width">
            <h3>Exam Finish</h3>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Exam Finish</a></li>
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

                <table class="table-border table-bordered table-hover table-responsive text-center"
                       style="font-size: 24px;">
                    <thead>
                    <tr style="font-weight: bold;">
                        <td>Exam Name</td>
                        <td>{{$singleexam->name}}</td>
                    </tr>
                    </thead>
                    <tbody>


                    <tr>
                        <td>TOTAL QUESTION</td>
                        <td>{{$num_Q}}</td>
                    </tr>


                    <tr>
                        <td>QUESTION ANSWERED</td>
                        <td>{{$ans_Q}}</td>
                    </tr>


                    <tr>
                        <td>RIGHT ANSWER</td>
                        <td>{{$ra_Q}}</td>
                    </tr>

                    <tr>
                        <td>WRONG ANSWER</td>
                        <td>{{$wa_Q}}</td>
                    </tr>


                    <tr>
                        <td>SCORE</td>
                        <td><b style="color: red;">{{$score_Q}} %</b></td>
                    </tr>


                    </tbody>
                </table>
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
