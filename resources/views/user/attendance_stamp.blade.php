@extends('layouts.user')
@section('content')
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper" style="max-width: 500px;">
        <div class="animate form login_form">
            <section class="login_content">
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav class="nav navbar-nav">
                            <ul class=" navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"  href="{{ route('profile', Auth::user()->id) }}"> プロフィール</a>
                                        <a class="dropdown-item"  href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i>ログアウト</a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                        <div class="product-image">
                            <img src="{{ asset('assets/img/login_banner.png') }}" alt="..."  style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <div class="profile clearfix">
                            <div class="profile_info">
                                <span style="color:black; font-weight: 800;">{{ Auth::user()->user_name; }}</span>
                                <h2 style="color:black;">ID:{{ Auth::user()->id; }}</h2>
                            </div>
                            <div class="profile_pic">
                                @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="..." class="img-circle profile_img">
                                @else
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="..." class="img-circle profile_img">
                                @endif
                            </div>
                        </div>
                        <h1 style="color:black; font-size:15px;">会社名:{{ App\Models\Company::where('id', Auth::user()->company_id)->first()->company_name; }}</h1>
                    </div>
                </div>
                <h3>勤怠打刻</h3>
                <div class="col-md-12 col-m-12 col-12 mb-5">
                    <span class="clock"></span>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div id="history"></div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-6 col-6">
                        <button class="btn-lg btn-primary rounded-lg w-100" id="attendance_work">出勤</button>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <button class="btn-lg btn-primary rounded-lg w-100" id="leaving_work">退勤</button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6 col-sm-6 col-6">
                        <button class="btn-lg btn-primary rounded-lg w-100" id="break_begins">休憩開始</button>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <button class="btn-lg btn-primary rounded-lg w-100" id="break_ends">休憩終了</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#attendance_work").on('click', function(){
            const spans = $('.clock span');
            const now_h_1 = spans[0].dataset.now;
            const now_h_2 = spans[1].dataset.now;
            const now_m_1 = spans[2].dataset.now;
            const now_m_2 = spans[3].dataset.now;
            const now_s_1 = spans[4].dataset.now;
            const now_s_2 = spans[5].dataset.now;
            const time = now_h_1 + now_h_2 + ":" + now_m_1 + now_m_2 + ":" + now_s_1 + now_s_2;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('attendance_work') }}",
                type: 'POST',
                data: {
                    time:time,
                    param:1
                },
                success: function (response) {
                    var element = document.getElementById("history");
                    element.textContent = response + "出勤";
                    
                }
            });
        });

        $("#leaving_work").on('click', function(){
            const spans = $('.clock span');
            const now_h_1 = spans[0].dataset.now;
            const now_h_2 = spans[1].dataset.now;
            const now_m_1 = spans[2].dataset.now;
            const now_m_2 = spans[3].dataset.now;
            const now_s_1 = spans[4].dataset.now;
            const now_s_2 = spans[5].dataset.now;
            const time = now_h_1 + now_h_2 + ":" + now_m_1 + now_m_2 + ":" + now_s_1 + now_s_2;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('attendance_work') }}",
                type: 'POST',
                data: {
                    time:time,
                    param:2
                },
                success: function (response) {
                    var element = document.getElementById("history");
                    element.textContent = response + "退勤";
                }
            });
        });

        $("#break_begins").on('click', function(){
            const spans = $('.clock span');
            const now_h_1 = spans[0].dataset.now;
            const now_h_2 = spans[1].dataset.now;
            const now_m_1 = spans[2].dataset.now;
            const now_m_2 = spans[3].dataset.now;
            const now_s_1 = spans[4].dataset.now;
            const now_s_2 = spans[5].dataset.now;
            const time = now_h_1 + now_h_2 + ":" + now_m_1 + now_m_2 + ":" + now_s_1 + now_s_2;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('attendance_work') }}",
                type: 'POST',
                data: {
                    time:time,
                    param:3
                },
                success: function (response) {
                    var element = document.getElementById("history");
                    element.textContent = response + "休憩開始";
                }
            });
        });

        $("#break_ends").on('click', function(){
            const spans = $('.clock span');
            const now_h_1 = spans[0].dataset.now;
            const now_h_2 = spans[1].dataset.now;
            const now_m_1 = spans[2].dataset.now;
            const now_m_2 = spans[3].dataset.now;
            const now_s_1 = spans[4].dataset.now;
            const now_s_2 = spans[5].dataset.now;
            const time = now_h_1 + now_h_2 + ":" + now_m_1 + now_m_2 + ":" + now_s_1 + now_s_2;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('attendance_work') }}",
                type: 'POST',
                data: {
                    time:time,
                    param:4
                },
                success: function (response) {
                    var element = document.getElementById("history");
                    element.textContent = response + "休憩終了";
                }
            });
        });

    </script>
@endsection