<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>

    <meta name="description" content="" />
    <link href="{{ asset('assets/img/favicon/favicon.png') }}" rel="icon">
    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <!-- Dropzone.js -->
    <link href="{{ asset('assets/vendors/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/build/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}" />
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/loader-4.css') }}" /> -->
   
    @yield('css')

    <!-- <div class="loader-wrapper" id="loader-4"
        style="display: inherit; width: 100%; height: 100%; background: lightgrey; position:fixed; top: 0; left: 0; z-index: 10000;">
        <div id="loader">少</div>
        <div id="loader">々</div>
        <div id="loader">お</div>
        <div id="loader">待</div>
        <div id="loader">ち</div>
        <div id="loader">く</div>
        <div id="loader">だ</div>
        <div id="loader">さ</div>
        <div id="loader">い</div>
        <div id="loader">。</div>
    </div> -->
</head>

<body class="nav-md">
    <!-- Layout wrapper -->
    <div class="container body">
        <div class="main_container ">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    {{-- @if(isset(App\Models\Material::where('user_id', Auth::user()->id)->first()->dt1))
                        <div class="navbar nav_title" style="border: 0;">
                            <img src="{{ App\Models\Material::where('user_id', Auth::user()->id)->first()->dt1 }}" alt="..." style="width: 100%; height: 100%;">
                        </div>
                        <div class="clearfix"></div>
                    @else --}}
                        <div class="navbar nav_title" style="border: 0;">
                            <img src="{{ asset('assets/img/login_banner.png') }}" alt="..." style="width: 100%;">
                        </div>
                        <div class="clearfix"></div>
                    {{-- @endif --}}
                    </br>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li>
                                    <a><i class="fa fa-user"></i> 従業員管理 <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('company.staff_list') }}">従業員一覧</a></li>                                        
                                        <li><a href="{{ route('company.staff_add') }}">新規追加</a></li>
                                        {{-- <li><a href="{{ route('company.staff_history') }}">従業員ログ</a></li> --}}
                                        <li><a href="{{ route('company.department_list') }}">部署一覧</a></li>
                                        {{-- <li><a href="{{ route('company.department_history') }}">部署ログ</a></li> --}}
                                        <li><a href="{{ route('company.metaitem_list') }}">従業員管理項目一覧</a></li>
                                        <li><a href="{{ route('company.job_create') }}">役職管理</a></li>
                                        <li><a href="{{ route('company.working_time_set') }}">勤務時間設定</a></li>
                                        {{-- <li><a href="{{ route('company.salary') }}">給与情報</a></li> --}}
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-car"></i> 勤怠管理 <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('company.attend_list') }}">勤怠一覧</a></li>
                                        <li><a href="{{ route('company.sheet_list') }}">シフト一覧</a></li>
                                        {{-- <li><a href="#">申請承認管理</a></li> --}}
                                    </ul>
                                </li>
                                {{-- <li>
                                    <a><i class="fa fa-money"></i> 支払い管理 <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('company.pay_list') }}">支払い一覧</a></li>                                       
                                    </ul>
                                </li> --}}
                                <li>
                                    <a><i class="fa fa-th-list"></i> 変更情報詳細 <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        {{-- <li><a href="{{ route('company.staff_history') }}">従業員履歴</a></li>                                      --}}
                                        <li><a href="{{ route('company.department_history') }}">部署履歴</a></li>                                     
                                        {{-- <li><a href="{{ route('company.job_history') }}">役職履歴</a></li> --}}
                                        {{-- <li><a href="{{ route('company.pay_list') }}">支払い一覧</a></li> --}}
                                    </ul>
                                </li>

                            </ul>
                        </div>

                    </div>

                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav ">
                <div class="nav_menu">
                    <div class="nav toggle" style="padding-top: 5px;">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px; padding-top: 5px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    @if (isset(Auth::user()->avatar))
                                    <img src="{{ Auth::user()->avatar }}" alt="">{{ Auth::user()->name }}
                                    @else
                                    <img src="{{ asset('avatars/default.png')}}" alt="">{{ Auth::user()->name; }}
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('company.company_profile', Auth::user()->id)}}"> プロフィール</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fa fa-sign-out pull-right"></i>
                                        ログアウト
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <h2 style="font-weight: bold;">{{ App\Models\Company::where('user_id', Auth::user()->id)->first()->company_name }}</h2>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right ">
                    moonrider.crowdworks@gmail.com @ 2024
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('assets/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('assets/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('assets/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('assets/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Dropzone.js -->
    <script src="{{ asset('assets/vendors/dropzone/dist/dropzone.js') }}"></script>
    <!-- jquery.inputmask -->
    <script src="{{ asset('assets/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
        <!-- Custom Theme Scripts -->
    <script src="{{ asset('assets/build/js/custom.js') }}"></script>

    <script src="{{ asset('assets/vendors/validator/multifield.js') }}"></script>
    <script src="{{ asset('assets/vendors/validator/validator.js') }}"></script>
    <script src="{{ asset('assets/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>


    <script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.js') }}"></script>

    <script src="{{ asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/pdfmake/build/vfs_fonts.js') }}"></script>



    <script src="{{ asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    
    @yield('script')
    <script>
    function hideshow() {
        var password = document.getElementById("password1");
        var slash = document.getElementById("slash");
        var eye = document.getElementById("eye");

        if (password.type === 'password') {
            password.type = "text";
            slash.style.display = "block";
            eye.style.display = "none";
        } else {
            password.type = "password";
            slash.style.display = "none";
            eye.style.display = "block";
        }

    }
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        setTimeout(removeSpinner, 1000); //wait for page load PLUS time.

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
        });

        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        // document.forms[0].onsubmit = function(e) {
        //     var submit = true,
        //         validatorResult = validator.checkAll(this);
        //     console.log(validatorResult);
        //     return !!validatorResult.valid;
        // };
        // on form "reset" event
        // document.forms[0].onreset = function(e) {
        //     validator.reset();
        // };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    });

    function removeSpinner() {
        $("#loader-4").fadeOut(70, function() { // fadeOut complete. Remove the loadingSpinner
            $("#loader-4").hide(); //makes page more lightweight 
        });
    }

    // initialize a validator instance from the "FormValidator" constructor.
    // A "<form>" element is optionally passed as an argument, but is not a must
    </script>
    
</body>

</html>