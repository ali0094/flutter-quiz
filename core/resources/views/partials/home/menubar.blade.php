<header>
    <div class="gt_top3_wrap default_width">
        <div class="container">
            <div class="gt_top3_scl_icon">
                <ul class="gt_hdr3_scl_icon">
                    <li><a href="{{ $social->facebook }}"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{ $social->twitter }}"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="{{ $social->google_plus }}"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="{{ $social->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="{{ $social->youtube }}"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="gt_hdr_3_ui_element">
                <ul>
                    <li><i class="fa fa-phone"></i>{{ $contact->number }}</li>
                    <li><i class="fa fa-envelope-o"></i>{{ $contact->email }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="gt_top3_menu default_width">
        <div class="container">
            <div class="gt-logo">
                <a href="{{ route('home') }}"><img src="{{ asset('images') }}/{{ $logo->name }}" alt=""></a>
            </div>
            <nav class="gt_hdr3_navigation">
                <!-- Responsive Buttun -->
                <a class="navbar-btn collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <!-- Responsive Buttun -->
                <ul class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <li class="{{ Request::is('/') ? "active" : "" }}"><a href="{{ route('home') }}">Home</a></li>
                    <li class="{{ Request::is('about-us') ? "active" : "" }}"><a href="{{ route('about_us') }}">About Us</a></li>
                    <li><a href="{{ route('exam') }}">Exam Category</a>
                        <ul>
                            @foreach($category as $c)
                                <li><a href="{{ route('exam_id',$c->id) }}">{{ $c->name }}</a></li>
                            @endforeach

                        </ul>
                    </li>
                    <li class="{{ Request::is('contact-us') ? "active" : "" }}"><a href="{{ route('contact-us') }}">Contact Us</a></li>
                    @if( Session::get('user') != "user" )
                    <li><a href="{{ route('userlogin') }}">Log In | Registration</a></li>
                    @else
                        <li><a href="#">Hi. {{ Auth::guard('user')->user()->name }}</a>
                            <ul>
                                <li><a href="{{ route('add_fund') }}">Add Fund</a></li>
                                <li><a href="#">Current Fund : {{ Auth::guard('user')->user()->balance }}</a></li>
                                <li><a href="{{ route('user-logout') }}">Log Out</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>