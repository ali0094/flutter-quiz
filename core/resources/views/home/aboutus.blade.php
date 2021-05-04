@extends('layouts.home')

@section('title', 'About Us')

@section('content')

    <!--Sub Banner Wrap Start -->
    <div class="gt_sub_banner_bg default_width">
        <div class="container">
            <div class="gt_sub_banner_hdg  default_width">
                <h3>About Us</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
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
                        <div class="gt_about_wrap">
                            <h4 class="title text-center">{{ $about->name }}</h4>
                            <p>{!! $about->description  !!}</p>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!--About Us Wrap End-->


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
    <!--Main Content Wrap End-->


@endsection