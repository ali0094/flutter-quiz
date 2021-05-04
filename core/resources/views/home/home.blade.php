@extends('layouts.home')

@section('title', 'Index Page')

@section('content')

    <!--Banner Wrap Start-->
    <div class="gt_banner default_width">
        <div class="swiper-container" id="swiper-container">
            <ul class="swiper-wrapper">
                @foreach($sliders as $slider)
                <li class="swiper-slide">
                    <img src="{{ asset('extra-images') }}/{{ $slider->name }}" alt="">
                    <div class="gt_banner_text gt_slide_1">
                        <h3>{{ $slider->small_text }}</h3>
                        <h2>{{ $slider->bold_text }}</h2>
                    </div>
                </li>
                @endforeach

            </ul>
        </div>
        <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
        <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
    </div>
    <!--Banner Wrap End-->

    <div class="gt_main_content_wrap">
        <!--Banner Services Wrap Start-->
        <div class="gt_servicer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="gt_main_services bg_1">
                            <i class="icon-write-board"></i>
                            <h5>Courses</h5>
                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
                            <a  class="bg_1" href="#"> <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="gt_main_services bg_2">
                            <i class="icon-teacher-showing-on-whiteboard"></i>
                            <h5>Professional Teachers</h5>
                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
                            <a class="bg_2" href="#"> <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="gt_main_services bg_3">
                            <i class="icon-compass"></i>
                            <h5>Fully Equiped</h5>
                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
                            <a class="bg_3" href="#"> <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="gt_main_services bg_4">
                            <i class="icon-number-blocks"></i>
                            <h5>Special Education</h5>
                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
                            <a class="bg_4" href="#"> <i class="fa fa-arrow-right"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Banner Services Wrap End-->

        <!--Offer Wrap start-->
        <section class="gt_wht_offer_bg">
            <div class="container">
                <div class="gt_hdg_1">
                    <h3>{{ $offer->title }}</h3>
                    <span><img src="{{ asset('images/hdg-01.png') }}" alt=""></span>
                </div>
                <!--What We Offer 2 Wrap Start-->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="gt_wht_offer_wrap mb">
                            <div class="gt_wht_offer_des">
                                <p class="lead" style="font-size: 18px">{!! $offer->description  !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--What We Offer 2 Wrap End-->
            </div>
        </section>
        <!--offer Wrap End-->

        <!--Facts and Figure Wrap End-->
        <section class="fact_figure_bg">
            <div class="container">
                <div class="gt_hdg_1 white_hdg">
                    <h3>Our Company History</h3>
                    <span><img src="{{ asset('images/hdg-01.png') }}" alt=""></span>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_facts_wrap">
                            <h2 class="counter">{{ $subcategory }}</h2>
                            <span>Total Category</span>
                        </div>
                        <span class="facts_border bg_1"></span>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_facts_wrap">
                            <h2 class="counter">{{ $question }}</h2>
                            <span>Total Question</span>
                        </div>
                        <span class="facts_border bg_2"></span>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_facts_wrap">
                            <h2 class="counter">{{ $exam }}</h2>
                            <span>Total Exam</span>
                        </div>
                        <span class="facts_border bg_3"></span>
                    </div>

                </div>
            </div>
        </section>
        <!--Facts and Figure Wrap End-->

        <!--Popular Courses Wrap Start-->
        <section>
            <div class="container">
                <div class="gt_hdg_1">
                    <h3>Popular Exam</h3>
                    <span><img src="{{ asset('images/hdg-01.png') }}" alt=""></span>
                </div>


                <!--Popular Courses List Wrap Start-->
                <div id="filterable-item-holder-1">
                    @php
                    $i= 0;
                    @endphp
                    @foreach($category as $c )
                    <?php if($i == 3) break; ?>
                    <div class="filterable-item all 1 col-md-4 col-sm-6 col-xs-12">
                        <div class="gt_latest_course2_wrap default_width">
                            <figure>
                                <img src="{{ asset('extra-images') }}/{{ $c->image }}" alt="">
                            </figure>
                            <div class="gt_latest_course_des default_width">
                                <h5><a href="#">{{ $c->name }}</a>
                                    <span class="pull-right">Price : @if($c->price != 0)
                                            @foreach($currency as $cr)
                                                @if($c->currency  == $cr->id )
                                                    {{ $cr->name }} {{ $c->price }}
                                                @endif
                                            @endforeach
                                        @else
                                            {{ "Free" }}
                                        @endif</span>
                                </h5>

                                <p>{{ $c->description }}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="apply" style="text-align: center; margin-bottom: 10px">
                                        <a href="{{ route('exam_start',$c->id) }}" class="btn btn-success btn-lg">Start Exam</a>
                                        {{--<a data-toggle="modal" data-target="#apply_form" href="#">Apply</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php $i++; ?>
                    @endforeach

                </div>
                <div class="gt_view_more default_width">
                    <a href="{{ route('exam') }}">Show All</a>
                </div>
                <!--Popular Courses List Wrap End-->

            </div>
        </section>
        <!--Popular Courses Wrap End-->

        <!--Our Client Wrap Start-->
        <section>
            <div class="container">
                <!--Main Heading Wrap Start-->
                <div class="gt_hdg_1">
                    <h3>Our Sponsors</h3>
                    <span><img src="{{ asset('images/hdg-01.png') }}" alt=""></span>
                </div>
                <!--Main Heading Wrap End-->

                <!--Brand List Wrap Start-->
                <div class="gt_brand_carousel owl-carouse">
                    @foreach($partner as $p)
                    <div class="item">
                        <div class="gt_brand_outer_wrap">
                            <a href="#"><img src="{{ asset('extra-images') }}/{{ $p->image }}" alt="{{ $p->name }}"></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--Brand List Wrap End-->

            </div>
        </section>
        <!--Our Client Wrap End-->
    </div>


@endsection