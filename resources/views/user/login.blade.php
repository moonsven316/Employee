@extends("layouts.auth")

@section("content")
<div class="login_wrapper">
    <div class="animate form login_form">
        <form id="demo-form" data-parsley-validate="" novalidate="" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="col-md-12 col-sm-12 col-12 mb-5">
                <div class="product-image">
                    <img src="{{ asset('assets/img/login_banner.png') }}" alt="..."  style="width: 100%;">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-12 mb-3">
                <label for="fullname">ユーザーID</label>
                <input type="text" class="form-control" id="email" name="email" placeholder=" " required/>
                @error('email')
                <small class="text-danger text-xs">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-12 col-sm-12 col-12 mb-5">
                <label for="email">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" placeholder=" " required/>
            </div>
            <div class="col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-sm-4 col-4"></div>
                    <div class="col-sm-4 col-4">
                        <button class="btn btn-primary roundedi-md" type="submit">ログイン</button>
                    </div>
                    <div class="col-sm-4 col-4"></div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection