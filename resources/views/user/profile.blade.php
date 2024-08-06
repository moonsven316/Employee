<!DOCTYPE html>
<html
	lang="en"
	class="light-style customizer-hide"
	dir="ltr"
	data-theme="theme-default"
	data-assets-path="{{ asset('assets/') }}"
	data-template="vertical-menu-template-free"
>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{{ env('APP_NAME') }}</title>
    @section('css')
        <style>
        body
        {
            background-color:#f5f5f5;
        }
        .imagePreview {
            width: 150px;
            height: 150px;
            background-position: center center;
            background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color:#fff;
            background-size: cover;
            background-repeat:no-repeat;
            display: inline-block;
            /* box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2); */
            border:solid 1px rgb(108 117 125);
        }
        .imgUp
        {
            margin-bottom:15px;
        }
        .del
        {
            /* position:absolute; */
            top:0px;
            right:15px;
            width:30px;
            height:30px;
            text-align:center;
            line-height:30px;
            background-color:rgba(255,255,255,0.6);
            cursor:pointer;
        }
        .imgAdd
        {
            width:30px;
            height:30px;
            border-radius:50%;
            background-color:#007bff;
            color:#fff;
            box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
            text-align:center;
            line-height:30px;
            margin-top:0px;
            cursor:pointer;
            font-size:15px;
        }
        .img{
            width: 145px;
            height: 148px;
        }
        </style>
    @endsection
    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">


	
	<link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
	<link href="{{ asset('assets/vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
	<!-- Select2 -->
	<link href="{{ asset('assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
	<!-- Switchery -->
	<link href="{{ asset('assets/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
	<!-- starrr -->
	<link href="{{ asset('assets/vendors/starrr/dist/starrr.css') }}" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>新規追加</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-label-left" style="padding:0px" action="{{ route('user_update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <h2>プロフィール情報</h2>
                                    <div class="form-group row">
        
                                        <div class="col-md-6 col-sm-6 ">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">メール
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <input type="mail" id="email" name="email" required="required" class="form-control" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 ">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="first-name">部署選択
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <select id="depart_id" name="depart_id" class="form-control" required>
                                                        @foreach(App\Models\Department::where('company_id', $user->company_id)->get() as $dep)
                                                        <option value="{{$dep->id}}" @if($user->depart_id == $dep->id) selected @endif>{{$dep->depart}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 ">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">パスワード
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <input type="password" id="password" name="password" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 ">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">パスワード確認
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <input type="password" id="password_confirm" name="password_confirm" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h2>個人情報</h2>
                                    <div class="form-group row">
        
                                        <div class="col-md-6 col-sm-6 ">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">名前
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <div class="col-md-12 col-sm-12 p-0 pb-1">
                                                        <input type="text" id="user_name" name="user_name" required="required"
                                                            class="form-control  " value="{{ $user->user_name }}">
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 p-0">
                                                        <input type="text" id="user_name_g" name="user_name_g"
                                                            required="required" class="form-control  " value="{{ $user->user_name_g }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">住所
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <div class="col-md-12 col-sm-12 p-0 pb-1">
                                                        <input type="text" id="post_code" name="post_code" required="required"
                                                            data-inputmask="'mask' : '999-9999'" class="form-control  " value="{{ $user->post_code }}">
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 p-0">
                                                        <input type="text" id="address" name="address" required="required"
                                                            class="form-control  " value="{{ $user->address }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">国籍
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <input type="text" id="country" name="country" required="required"
                                                        class="form-control  " value="{{ $user->country }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="first-name">電話番号
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <input type="text" id="phone" name="phone" required="required"
                                                        data-inputmask="'mask' : '999 9999 9999'" class="form-control  " value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 " style="text-align: center">
                                            <div class="row">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4">
                                                    @if (isset($user->avatar))
                                                    <div class="imgUp">
                                                        <div class="imagePreview mb-2">
                                                            <img src="{{ $user->avatar }}" alt="img" class="img" style="width: 150px; height: 150px;"/>
                                                        </div>
                                                        <label class="btn btn-primary w-100">
                                                            アップロード
                                                            <input type="file" class="uploadFile img" id="avatar" value="{{ $user->avatar }}" hidden>
                                                            <input type="hidden" name="avatar" class="hidden" value="{{ $user->avatar }}">
                                                        </label>
                                                    </div>
                                                    @else
                                                    <div class="imgUp">
                                                        <div class="imagePreview mb-2">
                                                            <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" style="width: 150px; height: 150px;"/>
                                                        </div>
                                                        <label class="btn btn-primary w-100">
                                                            アップロード
                                                            <input type="file" class="uploadFile img" id="avatar" value="" hidden>
                                                            <input type="hidden" name="avatar" class="hidden" value="">
                                                        </label>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
        
                                        <div class="col-md-6 col-sm-6 ">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">性別
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 d-flex justify-content"
                                                    style="align-items: end; justify-content:space-between">
                                                    <label>
                                                        <input type="radio" class="flat" name="gender" value="1" @if ($user->gender == 1) checked="checked" @endif> 男
                                                    </label>
                                                    <label>
                                                        <input type="radio" class="flat" name="gender" value="2" @if ($user->gender == 2) checked="checked" @endif> 女
                                                    </label>
                                                    <label>
                                                        <input type="radio" class="flat" name="gender" value="0" @if ($user->gender == 3) checked="checked" @endif> なし
                                                    </label>
                                                </div>
                                            </div>
        
                                        </div>
                                        <div class="col-md-6 col-sm-6 ">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="first-name">生年月日
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <input type="date" id="birthday" name="birthday" required="required"
                                                        class="form-control  " value="{{ $user->birthday }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <button class="btn btn-primary" type="reset">リセット</button>
                                        <button type="submit" class="btn btn-success">保存</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
	<!-- NProgress -->
	<script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>
	<!-- bootstrap-progressbar -->
	<script src="{{ asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
	<!-- iCheck -->
	<script src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="{{ asset('assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
	<script src="{{ asset('assets/vendors/google-code-prettify/src/prettify.js') }}"></script>
	<!-- jQuery Tags Input -->
	<script src="{{ asset('assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
	<!-- Switchery -->
	<script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js') }}"></script>
	<!-- Parsley -->
	<script src="{{ asset('assets/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
	<!-- Autosize -->
	<script src="{{ asset('assets/vendors/autosize/dist/autosize.min.js') }}"></script>
	<!-- jQuery autocomplete -->
	<script src="{{ asset('assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
	<!-- starrr -->
	<script src="{{ asset('assets/vendors/starrr/dist/starrr.js') }}"></script>
	<!-- Custom Theme Scripts -->
	<script src="{{ asset('assets/build/js/custom.min.js') }}"></script>
    <script>
        $(function() {
            $(document).on("change",".uploadFile", function()
            {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return;
        
                if (/^image/.test( files[0].type)){
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function(){
                        // alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').find('.img').attr('src', ""+this.result+"");
                        uploadFile.closest(".imgUp").find('.hidden').attr("value", ""+this.result+"");
                    }
                }
            });
        });
    </script>
</body></html>
