@extends('layouts.home')

@section('title', 'Exam category')

@section('content')

    <!--Sub Banner Wrap Start -->
    <div class="gt_sub_banner_bg default_width">
        <div class="container">
            <div class="gt_sub_banner_hdg  default_width">
                <h3>Exam Review</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">Exam Review</a></li>
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
                        <div class="col-md-4">
                            <div class="title text-center">
                                <h4>Number Of Question : {{ $numq }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <h4 class="title text-center">Exam : {{ $singleexam->name }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="title text-center">
                                <h4>Time : {{ $singleexam->time / 60 }} Min</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="filterable-item all ">
                            <div class="gt_latest_course2_wrap default_width">
                                <figure>
                                    <img src="{{ asset('extra-images') }}/{{ $singleexam->image }}" alt="" style="width: 360px; height: 275px">
                                    <figcaption>
                                        <div class="course_price">
                                            @if($singleexam->price != 0)
                                                @foreach($currency as $cr)
                                                    @if($singleexam->currency  == $cr->id )
                                                        {{ $cr->name }}{{ $singleexam->price }}
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ "Free" }}
                                            @endif
                                        </div>
                                    </figcaption>
                                </figure>
                                <div class="gt_latest_course_des default_width">
                                    <h5><a href="#">{{ $singleexam->name }}</a></h5>
                                    <p>{{ $singleexam->description }}</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="apply" style="text-align: center; margin-bottom: 10px">
                                            <a href="{{ route('exam_confirm',$singleexam->id) }}" onclick="return confirm('Are You Ready For Start This Exam.');" class="btn btn-success btn-block btn-lg">Start Exam</a>
                                        </div>
                                    </div>
                                </div>
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
