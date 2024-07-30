@extends('layouts.main')
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
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>従業員編集</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_content1" role="tab" aria-controls="home" aria-selected="true">基本情報</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_content2" role="tab" aria-controls="profile" aria-selected="false">給与情報</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="work-days" data-toggle="tab" href="#tab_content3" role="tab" aria-controls="working_days" aria-selected="false">所定日数設定</a>
                                </li>
                            </ul>
                            <form id="info_form" action="{{ route('company.staff_edit_save') }}" method="POST">
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">
                                        <div class="form-label-left" style="padding:0px">
                                            @csrf
                                            <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                                            <h2>ログイン情報</h2>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">メール
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            {{-- <input type="mail" id="email" name="email" required="required" class="form-control" value="{{ $staff->email }}"> --}}
                                                            <input type="text" id="email" name="email" data-inputmask="'alias': 'email'" class="form-control" im-insert="true" value="{{ $staff->email }}">
                                                            @error('email')
                                                                <span class="text-danger">メールは必須です。</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ユーザーID
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <input type="mail" id="name" name="name" required="required" class="form-control" value="{{ $staff->name }}">
                                                            @error('name')
                                                                <span class="text-danger">ユーザーIDはすでに取られています。</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">親部門
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <select id="depart_id" name="depart_id" class="form-control" required onchange="getSubDepart()">
                                                                <option value="0">親部門選択</option>
                                                                @foreach($departments as $dep)
                                                                <option value="{{$dep->id}}" @if($staff->depart_id == $dep->id) selected @endif>{{$dep->depart}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">子部門
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <select id="sub_depart_id" name="sub_depart_id" class="form-control" required>
                                                                <option value="0">子部門選択</option>
                                                                @foreach ($sub_department as $subdepart)
                                                                    <option value="{{ $subdepart->id }}" @if($staff->sub_depart_id == $subdepart->id) selected @endif>{{ $subdepart->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">カード番号
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <input type="text" id="idm" name="idm" required="required" class="form-control" value="{{ $staff->idm }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">役職
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <select id="job_id" name="job_id" class="form-control" required>
                                                                <option value="0">役職選択</option>
                                                                @foreach ($job as $job_item)
                                                                    <option value="{{ $job_item->id }}" @if($staff->job_id == $job_item->id) selected @endif>{{ $job_item->name }}</option>
                                                                @endforeach
                                                            </select>
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
                                                                <input type="text" id="user_name" name="user_name" required="required" class="form-control" value="{{ $staff->user_name }}">
                                                                @error('user_name')
                                                                    <span class="text-danger">この項目は必須です。</span><br>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 p-0">
                                                                <input type="text" id="user_name_g" name="user_name_g" required="required" class="form-control" value="{{ $staff->user_name_g }}">
                                                                @error('user_name_g')
                                                                    <span class="text-danger">この項目は必須です。</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">〒
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <div class="col-md-12 col-sm-12 p-0 pb-1 d-flex">
                                                                {{-- <input type="text" id="post_code" name="post_code" required="required" data-inputmask="'mask' : '999-9999'" class="form-control" value="{{ $staff->post_code }}"> --}}
                                                                <input type="text" name="zip1" size="4" maxlength="3" class="form-control" value="{{ $staff->zip1 }}">
                                                                <span>－</span>
                                                                <input class="form-control" type="text" name="zip2" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','addr','str');"  value="{{ $staff->zip2 }}">
                                                            </div>
                                                            @error('zip1')
                                                                <span class="text-danger">郵便番号はすでに取られています。</span><br>
                                                            @enderror
                                                            @error('zip2')
                                                                <span class="text-danger">郵便番号はすでに取られています。</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">住所
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <div class="col-md-12 col-sm-12 p-0">
                                                                <div class="col-md-12 col-sm-12 p-0 pb-1">
                                                                    <input class="form-control" type="text" name="pref" value="{{ $staff->pref }}">
                                                                    @error('pref')
                                                                        <span class="text-danger">この項目は必須です。</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 p-0 pb-1">
                                                                    <input class="form-control" type="text" name="addr" value="{{ $staff->addr }}">
                                                                    @error('addr')
                                                                        <span class="text-danger">この項目は必須です。</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 p-0">
                                                                    <input class="form-control" type="text" name="str" value="{{ $staff->str }}">
                                                                    @error('str')
                                                                        <span class="text-danger">この項目は必須です。</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">国籍
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <input type="text" id="country" name="country" required="required" class="form-control" value="{{ $staff->country }}">
                                                            @error('country')
                                                                <span class="text-danger">国籍はすでに取られています。</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">電話番号
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <input type="text" id="phone" name="phone" required="required" data-inputmask="'mask' : '(999) 999-9999'" class="form-control" value="{{ $staff->phone }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 " style="text-align: center">
                                                    <div class="row">
                                                        <div class="col-sm-4"></div>
                                                        <div class="col-sm-4">
                                                            @if (isset($staff->avatar))
                                                            <div class="imgUp">
                                                                <div class="imagePreview mb-2">
                                                                    <img src="{{ $staff->avatar }}" alt="img" class="img" />
                                                                    <label class="btn btn-primary w-100 mt-2">
                                                                        アップロード
                                                                        <input type="file" class="uploadFile img" id="avatar" value="{{ $staff->avatar }}" hidden>
                                                                        <input type="hidden" name="avatar" class="hidden" value="{{ $staff->avatar }}">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="imgUp">
                                                                <div class="imagePreview mb-2">
                                                                    <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                                    <label class="btn btn-primary w-100 mt-2">
                                                                        アップロード
                                                                        <input type="file" class="uploadFile img" id="avatar" value="" hidden>
                                                                        <input type="hidden" name="avatar" class="hidden" value="">
                                                                    </label>
                                                                </div>
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
                                                                <input type="radio" class="flat" name="gender" value="1" @if ($staff->gender == 1) checked="checked" @endif> 男
                                                            </label>
                                                            <label>
                                                                <input type="radio" class="flat" name="gender" value="2"@if ($staff->gender == 2) checked="checked" @endif> 女
                                                            </label>
                                                            <label>
                                                                <input type="radio" class="flat" name="gender" value="0"@if ($staff->gender == 0) checked="checked" @endif> なし
                                                            </label>
                                                        </div>
                                                    </div>
                
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">生年月日
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <input type="date" id="birthday" name="birthday" required="required" class="form-control" value="{{ $staff->birthday }}">
                                                            @error('birthday')
                                                                <span class="text-danger">生年月日はすでに取られています。</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                
                                            </div>
                
                                            <div class="form-group row">
                
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">社会保険
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <input type="text" id="social_num" name="social_num" required="required" class="form-control" value="{{ $staff->social_num }}">
                                                        </div>
                                                    </div>
                
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">雇用保険番号
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <input type="text" id="employ_num" name="employ_num" required="required" class="form-control" value="{{ $staff->employ_num }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="total_work_time">勤務時間
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <select name="total_work_time" id="total_work_time" class="form-control">
                                                                <option value="{{ $worktime->first_day }}" @if ($staff->total_work_time == $worktime->first_day) selected @endif>28日の月：{{ $worktime->first_day }}時間</option>
                                                                <option value="{{ $worktime->second_day }}" @if ($staff->total_work_time == $worktime->first_day) selected @endif>29日の月：{{ $worktime->second_day }}時間</option>
                                                                <option value="{{ $worktime->third_day }}" @if ($staff->total_work_time == $worktime->first_day) selected @endif>30日の月：{{ $worktime->third_day }}時間</option>
                                                                <option value="{{ $worktime->fourth_day }}" @if ($staff->total_work_time == $worktime->first_day) selected @endif>31日の月：{{ $worktime->fourth_day }}時間</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">給料日
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 ">
                                                            <?php $total_day = date('t'); ?>
                                                            <select name="salary_date" id="salary_date" class="form-control">
                                                                @for ($i = 1; $i <= $total_day; $i++)
                                                                    <option value="{{ $i }}" @if ($i == $staff->salary_date) selected @endif>{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="meta" id="meta" value="">
                                            <h2>従業員情報</h2>
                                            <div class="form-group row" id="add_input">
                                                @foreach($metaitem as $meta)
                                                    @if($meta->kind == 1)
                                                        @if (isset($staff->metaitem))
                                                            @foreach (json_decode($staff->metaitem) as $key => $value)
                                                                @if ($key == $meta->metaitem_id)
                                                                <div class="col-md-6 col-sm-6 ">
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                            <span class="required">*</span>
                                                                        </label>
                                                                        <div class="col-md-8 col-sm-8 ">
                                                                            <input type="text" id='{{ $meta->metaitem_id }}' class="form-control" value="{{ $value }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-8 col-sm-8 ">
                                                                        <input type="text" id='{{ $meta->metaitem_id }}' class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if($meta->kind == 2)
                                                        @if (isset($staff->metaitem))
                                                            @foreach (json_decode($staff->metaitem) as $key => $value)
                                                                @if ($key == $meta->metaitem_id)
                                                                    <div class="col-md-6 col-sm-6 ">
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                                <span class="required">*</span>
                                                                            </label>
                                                                            <div class="col-md-8 col-sm-8 ">
                                                                                <input type="date" id='{{ $meta->metaitem_id }}' class="form-control" value="{{ $value }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-8 col-sm-8 ">
                                                                        <input type="date" id='{{ $meta->metaitem_id }}' class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if($meta->kind == 0)
                                                        @if (isset($staff->metaitem))
                                                            @foreach (json_decode($staff->metaitem) as $key => $value)
                                                                @if ($key == $meta->metaitem_id)
                                                                    <div class="col-md-6 col-sm-6 ">
                                                                        <?php
                                                                            $array = preg_split("/\r\n|\n|\r/", $meta->description);
                                                                        ?>
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                                <span class="required">*</span>
                                                                            </label>
                                                                            <div class="col-md-8 col-sm-8 d-flex justify-content">
                                                                                @foreach($array as $ar)
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" @if ($value == "true") checked="checked" @endif id="{{ $meta->metaitem_id }}">
                                                                                    </label>
                                                                                </div>
                                                                                <p class="control-label label-align px-2" for="first-name">{{$ar}}</p>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <?php
                                                                    $array = preg_split("/\r\n|\n|\r/", $meta->description);
                                                                ?>
                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-8 col-sm-8 d-flex justify-content">
                                                                        @foreach($array as $ar)
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" class="flat" checked="checked" id="{{ $meta->metaitem_id }}">
                                                                            </label>
                                                                        </div>
                                                                        <p class="control-label label-align px-2" for="first-name">{{$ar}}</p>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                @if ($staff->status != 2)
                                                <button type="reset" class="btn btn-primary">キャンセル</button>
                                                @endif
                                                <button type="button" class="btn btn-success" onclick="add_input()">保存</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 ">
                                                <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                    <input type="hidden" name="salary_id" id="salary_id" value="{{ isset($salary->id) ? $salary->id : 0 }}">
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="hourly_wage">時給</label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="hourly_wage" name="hourly_wage" class="form-control test" value="{{ isset($salary->hourly_wage) ? $salary->hourly_wage : 0 }}">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="basic_allowance">基本給</label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="basic_allowance" name="basic_allowance" class="form-control test" value="{{ isset($salary->basic_allowance) ? $salary->basic_allowance : 0 }}">
                                                        </div>
                                                    </div>
                
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="business_allowance">業務手当</label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="business_allowance" name="business_allowance" class="form-control test" value="{{ isset($salary->business_allowance) ? $salary->business_allowance : 0 }}">
                                                        </div>
                                                    </div>
                
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="position_allowance">役職手当</label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="position_allowance" name="position_allowance" class="form-control test" value="{{ isset($salary->position_allowance) ? $salary->position_allowance : 0 }}">
                                                        </div>
                                                    </div>
                
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="technical_allowance">技術手当</label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="technical_allowance" name="technical_allowance" class="form-control test" value="{{ isset($salary->technical_allowance) ? $salary->technical_allowance : 0 }}">
                                                        </div>
                                                    </div>
                
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="adjustment_allowance">出向調整金</label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="adjustment_allowance" name="adjustment_allowance" class="form-control test" value="{{ isset($salary->adjustment_allowance) ? $salary->adjustment_allowance : 0 }}">
                                                        </div>
                                                    </div>
                                                    <div id="item_list">
                                                        @if (!empty($salary->add_item))
                                                        @foreach (json_decode($salary->add_item) as $label => $content)
                                                            <div class="item form-group">
                                                                <div class="col-md-2 col-sm-2"></div>
                                                                <div class="col-md-1 col-sm-1">
                                                                    <input type="text" name="update_item_label_{{$loop->iteration}}" id="update_item_label_{{$loop->iteration}}" class="form-control" value="{{ $label }}">
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 ">
                                                                    <input type="text" name="update_item_content_{{$loop->iteration}}" id="update_item_content_{{$loop->iteration}}" class="form-control test" value="{{ $content }}">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a href="javascript:void(0);" id="removeAdditem">
                                                                        <i class="fa fa-trash-o mt-2 px-2" style="font-size: 20px; color: red;"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                    <div id="add_item_list"></div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-6">
                                                            <div class="text-center">
                                                                <button type="button" class="btn btn-primary" id="item_add">アイテム追加</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3"></div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                    <div class="row">
                                                        <div class="col-lg-2"></div>
                                                        <div class="col-lg-6">
                                                            @if ($staff->status != 2)
                                                            <button type="reset" class="btn btn-primary">キャンセル</button>
                                                            @endif
                                                            <button type="button" class="btn btn-success" onclick="add_input()">保存</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="work-days">
                                        <div data-parsley-validate class="form-horizontal form-label-left">
                                            @csrf
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first_day">28日 <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="number" id="first_day" name="first_day" required="required" class="form-control " value="{{ $staff->first_day }}">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="second_day">29日 <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="number" id="second_day" name="second_day" required="required" class="form-control" value="{{ $staff->second_day }}">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="third_day">30日 <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="number" id="third_day" name="third_day" required="required" class="form-control" value="{{ $staff->third_day }}">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="fourth_day">31日 <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="number" id="fourth_day" name="fourth_day" required="required" class="form-control" value="{{ $staff->fourth_day }}">
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 offset-md-3">
                                                    <button class="btn btn-primary" type="reset">リセット</button>
                                                    <button type="button" class="btn btn-success" onclick="add_input()">保存</button>
                                                </div>
                                            </div>
                    
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).on('keyup', '.test', function() {
        var x = $(this).val();
        $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });
    function add_input() {
        // var email = $("#email").val();
        // var name = $("#name").val();
        var depart_id = $("#depart_id").val();
        var sub_depart_id = $("#sub_depart_id").val();
        var job_id = $("#job_id").val();
        // var user_name = $("#user_name").val();
        // var user_name_g = $("#user_name_g").val();
        if (depart_id == 0 || sub_depart_id == 0 || job_id == 0) {
            alert("部門または役職を選択してください。");
        } else {
            var inputArr = $("#add_input input");
            var inputData = {};
            for (let i = 0; i < inputArr.length; i++) {
                var id = inputArr[i].id;
                if (inputArr[i].className == "flat") {
                    var value = inputArr[i].checked;
                } else {
                    var value = inputArr[i].value;
                }
                inputData[id] = value; 
            }
            $('#meta').val(JSON.stringify(inputData));
            if (Object.keys(inputData).length !== 0) {
                $("#info_form").submit();
            }
        }
    }
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

    function getSubDepart(){
        if ($("#depart_id").val() != 0) {
            $.ajax({
                url: "{{ route('company.staff_get_sub_depart') }}",
                method: 'post',
                data: {
                    depart_id: $("#depart_id").val()
                },
                success: function(data) {
                    if (data.length === 0) {
                        $("#sub_depart_id").html(`<option value="0">データがありません。</option>`);
                    } else {
                        var options = data.map(function(item) {
                            return `<option value="${item.id}">${item.name}</option>`;
                        }).join('');
                        $("#sub_depart_id").html(options);
                    }
                }
            });
        } else {
            $("#sub_depart_id").html(`<option value="0">子部門選択</option>`);
        }
    }
    var j = 1;
    $("#item_add").on('click', function(){
        var item_list = document.getElementById('add_item_list');
        var item = `<div class="item form-group">
                        <div class="col-md-2 col-sm-2"></div>
                        <div class="col-md-1 col-sm-1">
                            <input type="text" name="item_label_${j}" id="item_label_${j}" class="form-control">
                        </div>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="number" name="item_content_${j}" id="item_content_${j}" class="form-control" value="0">
                        </div>
                        <div class="col-md-3">
                            <a href="javascript:void(0);" id="removeAdditem">
                                <i class="fa fa-trash-o mt-2 px-2" style="font-size: 20px; color: red;"></i>
                            </a>
                        </div>
                    </div>`;
        item_list.insertAdjacentHTML('beforeend', item);
        j++;
    });
    $('#add_item_list').on('click', '#removeAdditem', function() {
        var $this = $(this);
        var $imgUp = $this.closest('.form-group');
        var index = $('.form-group').index($imgUp);
        $imgUp.remove();
    });
    $('#item_list').on('click', '#removeAdditem', function() {
        var $this = $(this);
        var $imgUp = $this.closest('.form-group');
        var index = $('.form-group').index($imgUp);
        $imgUp.remove();
    });
</script>
@endsection