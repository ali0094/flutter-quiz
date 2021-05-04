

<!--Footer Wrap Start-->
<div class="gt_footer_bg default_width">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="gt_office_wrap default_width" style="margin-top: 30px; overflow: hidden">
                    <div class="gt_foo_about widget">
                        <h5 class="text-center">About {{ $title->title }}</h5>
                        <p>{!! $footer->about_footer !!}</p>
                        <ul>
                            <li><a href="{{ $social->facebook }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ $social->twitter }}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ $social->google_pluse }}"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="{{ $social->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="{{ $social->youtube }}"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="foo_col_outer_wrap default_width">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="widget">
                                <h5>Our Address</h5>
                                <ul class="gt_team1_contact_info">
                                    <li><i class="fa fa-map-marker"></i>{{ $contact->address }}</li>
                                    <li><i class="fa fa-phone"></i>{{ $contact->number }}</li>
                                    <li><i class="fa fa-envelope"></i>{{ $contact->email }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--Footer Wrap End-->

<!--Copyright Wrap Start-->
<div class="copyright_bg default_width">
    <div class="container">
        <div class="copyright_wrap default_width">
            <p>{!! $footer->left_footer !!}</p>
            {{--<p>©copyrights.<a href="#">Kidscenter.com</a>. All Right Reserved.</p>--}}
            <span>{!! $footer->right_footer !!}</span>
            {{--<span>Designed By: <a href="#">2GoodTemplate</a></span>--}}
        </div>
    </div>
</div>
<!--Copyright Wrap End-->