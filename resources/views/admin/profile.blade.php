@extends('layouts.admin')
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">個人情報</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ログイン情報</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-12">
                        <div class="x_panel">
                            {{-- <div class="x_title">
                                <h2>新規追加</h2>
                                <div class="clearfix"></div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-label-left" style="padding:0px" action="{{ route('profile_save') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4 " style="text-align: center">
                                                @if (isset($admin->avatar))
                                                <img src="{{ $admin->avatar }}" width="170px" height="226px"/>
                                                @endif
                                                <img src="{{asset('')}}avatars/default.png" width="170px" height="226px"/>
                                            </div>
                                            <div class="col-md-8 col-sm-8 ">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        名前
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <div class="col-md-12 col-sm-12 p-0 pb-1">
                                                            <input type="text" id="user_name" name="user_name" required="required" class="form-control" value="{{ $admin->user_name }}">
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 p-0">
                                                            <input type="text" id="user_name_g" name="user_name_g" required="required" class="form-control" value="{{ $admin->user_name_g }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        住所
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <div class="d-flex">
                                                            <input type="tel" class="form-control has-feedback-left" id="zip1" name="zip1" placeholder="000" required="required" value="{{ $admin->zip1 }}" size="4" maxlength="3">                                 
                                                            <input type="tel" class="form-control has-feedback-left" id="zip2" name="zip2" placeholder="0000" required="required" value="{{ $admin->zip2 }}" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','addr','str');">                                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"></label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="tel" class="form-control has-feedback-left" id="pref" name="pref" placeholder="東京都" required="required" value="{{ $admin->pref }}">
                                                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"></label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="tel" class="form-control has-feedback-left" id="addr" name="addr" placeholder="品川区" required="required" value="{{ $admin->addr }}">
                                                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"></label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="tel" class="form-control has-feedback-left" id="str" name="str" placeholder="0-0-0" required="required" value="{{ $admin->str }}">
                                                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        国籍
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="text" id="country" name="country" required="required" class="form-control" value="{{ $admin->country }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        電話番号
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="text" id="phone" name="phone" required="required" data-inputmask="'mask' : '999 9999 9999'" class="form-control" value="{{ $admin->phone }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-4 ">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        性別
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 d-flex justify-content" style="align-items: end; justify-content:space-between">
                                                        <label>
                                                            <input type="radio" class="flat" name="gender" value="1" @if ($admin->gender == 1) checked="checked" @endif> 男
                                                        </label>
                                                        <label>
                                                            <input type="radio" class="flat" name="gender" value="2" @if ($admin->gender == 2) checked="checked" @endif> 女
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-8 ">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        生年月日
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="date" id="birthday" name="birthday" required="required" class="form-control" value="{{ $admin->birthday }}">
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
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-label-left" style="padding:0px" action="{{ route('change_password') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-md-8 col-sm-8 ">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        メール
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <div class="col-md-12 col-sm-12 p-0 pb-1">
                                                            <input type="text" id="email" name="email" required="required" class="form-control" value="{{ $admin->email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        パスワード
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <div class="col-md-12 col-sm-12 p-0 pb-1">
                                                            <input type="password" id="password" name="password" required="required" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                                        パスワードの確認
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="password" id="password_confirm" name="password_confirm" required="required" class="form-control">
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
    </div>
</div>
@endsection