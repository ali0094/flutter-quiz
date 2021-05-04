@extends('layouts.home')

@section('title', 'Exam category')

@section('content')

<!--Sub Banner Wrap Start -->
<div class="gt_sub_banner_bg default_width">
    <div class="container">
        <div class="gt_sub_banner_hdg  default_width">
            <h3>Exam Category</h3>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Exam category</a></li>
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
                <div class="col-md-6">
                    <div class="gt_about_wrap">
                        <h4 class="title">Our All Exam Category</h4>
                        <div class="row">
                            <table class="table-border table-bordered table-hover table-responsive text-center">
                                <thead>
                                <tr>
                                    <td>Exam Name</td>
                                    <td>Price</td>
                                    <td>Time / Min</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category as $c)
                                    <tr>
                                        <td>{{ $c->name }}</td>
                                        <td>
                                            @if($c->price != 0)
                                                <label for="" class="label label-danger label-sm">
                                                    @foreach($currency as $cr)
                                                        @if($c->currency  == $cr->id )
                                                            {{ $cr->name }} {{ $c->price }}
                                                        @endif
                                                    @endforeach
                                                </label>
                                            @else
                                                <label for="" class="label label-primary label-sm">{{ "Free" }}</label>
                                            @endif
                                        </td>
                                        <td>{{ $c->time /60  }} Min</td>
                                        <td>
                                            <a href="{{ route('exam_start',$c->id) }}" class="btn btn-success btn-sm">Start Exam</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $category->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filterable-item all 1 col-md-4 col-sm-6 col-xs-12">
                    <h4 class="title">{{ $singleexam->name }} Category</h4>
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
                                    <a href="{{ route('exam_start',$singleexam->id) }}" class="btn btn-success btn-lg">Start Exam</a>
                                    {{--<a data-toggle="modal" data-target="#apply_form" href="#">Apply</a>--}}
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