@extends('layouts.main')
@section('css')
<style>
    .control-label {
        font-size: 15px !important;
    }
</style>
@endsection
@section('content')
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>従業員詳細</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-3 col-sm-3  profile_left">
                    <div class="profile_img">
                        <div id="crop-avatar">
                            @if (isset($staff->avatar))
                            <img class="img-responsive avatar-view" src="{{ $staff->avatar }}" alt="Avatar" title="Change the avatar" width="220" height="220">
                            @else
                            <img class="img-responsive avatar-view" src="{{ asset("avatars/man.jpg") }}" alt="Avatar" title="Change the avatar" width="220" height="220">
                            @endif
                        </div>
                        <h2 style="font-weight: bold;">{{ $staff->user_name }}</h2>
                        <ul class="list-unstyled user_data">
                            <li>
                                <p>

                                    <i class="fa fa-briefcase user-profile-icon"></i>
                                    <?php
                                        $job = App\Models\Job::find($staff->job_id);
                                    ?>
                                    @if (!empty($job))
                                    {{ $job->name }}
                                    @endif
                                </p>
                            </li>
                            <li class="m-top-xs">
                                <i class="fa fa-envelope-o"></i>
                                <a href="javascript:void(0);">{{ $staff->email }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <a class="btn btn-success w-100" href="{{ route('company.staff_edit', $staff->id) }}">編集</a>
                        </div>
                        <div class="col-lg-8">
                            <a class="btn btn-danger w-100" href="javascript:void(0);" onclick="staff_delete({{ $staff->id }})">削除</a>
                        </div>

                        @if ($staff->status != 1)
                        <div class="col-lg-8">
                            <a class="btn btn-info w-100" href="javascript:void(0);" onclick="staff_leave({{ $staff->id }})">休職処理</a>
                        </div>
                        @else
                        <div class="col-lg-8">
                            <a class="btn btn-info w-100" href="javascript:void(0);" onclick="return_leave({{ $staff->id }})">復職</a>
                        </div>
                        @endif

                        @if ($staff->status != 2)
                        <div class="col-lg-8">
                            <a class="btn btn-warning w-100" href="javascript:void(0);" onclick="retirement({{ $staff->id }})">退職処理</a>
                        </div>
                        @else
                        <div class="col-lg-8">
                            <a class="btn btn-warning w-100" href="javascript:void(0);" onclick="returnWork({{ $staff->id }})">復職</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 ">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_content1" role="tab" aria-controls="home" aria-selected="true">個人情報</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#tab_content2" role="tab" aria-controls="profile" aria-selected="false">ログイン情報</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#tab_content3" role="tab" aria-controls="profile" aria-selected="false">従業員情報</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#tab_content4" role="tab" aria-controls="profile" aria-selected="false">給与情報</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab5" data-toggle="tab" href="#tab_content5" role="tab" aria-controls="profile" aria-selected="false">部署・役職情報</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <div class="form-horizontal form-label-left">

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3">名前</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->user_name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 "></label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->user_name_g }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">国籍</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->country }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">電話番号</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->phone }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">性別</label>
                                                <div class="col-md-9 col-sm-9 d-flex justify-content" style="align-items: end; justify-content:space-between">
                                                    {{-- <h5>
                                                        <input type="radio" class="flat" name="gender" value="1" @if ($staff->gender == 1) checked="checked" @endif> 男
                                                    </h5>
                                                    <h5>
                                                        <input type="radio" class="flat" name="gender" value="2"@if ($staff->gender == 2) checked="checked" @endif> 女
                                                    </h5>
                                                    <h5>
                                                        <input type="radio" class="flat" name="gender" value="0"@if ($staff->gender == 0) checked="checked" @endif> なし
                                                    </h5> --}}
                                                    @if ($staff->gender == 1)
                                                        <h5><input type="radio" class="flat" name="gender" value="1" checked="checked"> 男</h5>
                                                    @elseif($staff->gender == 2)
                                                        <h5><input type="radio" class="flat" name="gender" value="1" checked="checked"> 女</h5>
                                                    @else
                                                        <h5><input type="radio" class="flat" name="gender" value="1" checked="checked"> なし</h5>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">年齢</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $age }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">勤続年数</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $year_service }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <div class="form-horizontal form-label-left">

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">〒</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->zip1 }}-{{ $staff->zip2 }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">住所</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->pref }}{{ $staff->addr }}{{ $staff->str }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">社会保険</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->social_num }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">雇用保険番号</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->employ_num }}">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">生年月日</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->birthday }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">入社日</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ explode(' ', $staff->created_at)[0] }}">
                                                </div>
                                            </div>

                                            <div class="form-group row" hidden>
                                                <label class="control-label col-md-3 col-sm-3 ">親部門</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <select id="depart_id" name="depart_id" class="form-control" required disabled="disabled">
                                                        @foreach($departments as $dep)
                                                        <option value="{{ $dep->depart }}" @if($staff->depart_id == $dep->id) selected @endif>{{ $dep->depart }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row" hidden>
                                                <label class="control-label col-md-3 col-sm-3 " for="first-name">子部門</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <select id="sub_depart_id" name="sub_depart_id" class="form-control" required disabled="disabled">
                                                        @foreach ($sub_department as $subdepart)
                                                            <option value="{{ $subdepart->name }}" @if($staff->sub_depart_id == $subdepart->id) selected @endif>{{ $subdepart->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 " for="total_work_time">勤務時間</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <select name="total_work_time" id="total_work_time" class="form-control" disabled="disabled">
                                                        <option value="{{ $worktime->first_day }}" @if ($staff->total_work_time == $worktime->first_day) selected @endif>28日の月：{{ $worktime->first_day }}時間</option>
                                                        <option value="{{ $worktime->second_day }}" @if ($staff->total_work_time == $worktime->first_day) selected @endif>29日の月：{{ $worktime->second_day }}時間</option>
                                                        <option value="{{ $worktime->third_day }}" @if ($staff->total_work_time == $worktime->first_day) selected @endif>30日の月：{{ $worktime->third_day }}時間</option>
                                                        <option value="{{ $worktime->fourth_day }}" @if ($staff->total_work_time == $worktime->first_day) selected @endif>31日の月：{{ $worktime->fourth_day }}時間</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 " for="first-name">給料日</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <?php $total_day = date('t'); ?>
                                                    <select name="salary_date" id="salary_date" class="form-control" disabled="disabled">
                                                        @for ($i = 1; $i <= $total_day; $i++)
                                                            <option value="{{ $i }}" @if ($i == $staff->salary_date) selected @endif>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6 ">
                                        <div class="form-horizontal form-label-left">

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">ユーザーID</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->name }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 ">カード番号</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <input type="text" class="form-control" disabled="disabled" value="{{ $staff->idm }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3"></div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group row" id="add_input">
                                            @foreach($metaitem as $meta)
                                                @if($meta->kind == 1)
                                                    @if (isset($staff->metaitem))
                                                        @foreach (json_decode($staff->metaitem) as $key => $value)
                                                            @if ($key == $meta->metaitem_id)
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <div class="form-group row">
                                                                    <label class="control-label  col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-8 col-sm-8 ">
                                                                        <input type="text" id='{{ $meta->metaitem_id }}' class="form-control" value="{{ $value }}" disabled="disabled">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <div class="form-group row">
                                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-8 col-sm-8 ">
                                                                    <input type="text" id='{{ $meta->metaitem_id }}' class="form-control" disabled="disabled">
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
                                                                        <label class="control-label  col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                            <span class="required">*</span>
                                                                        </label>
                                                                        <div class="col-md-8 col-sm-8 ">
                                                                            <input type="date" id='{{ $meta->metaitem_id }}' class="form-control" value="{{ $value }}" disabled="disabled">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <div class="form-group row">
                                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-8 col-sm-8 ">
                                                                    <input type="date" id='{{ $meta->metaitem_id }}' class="form-control" disabled="disabled">
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
                                                                        <label class="control-label  col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                            <span class="required">*</span>
                                                                        </label>
                                                                        <div class="col-md-8 col-sm-8 d-flex justify-content" style="">
                                                                            @foreach($array as $ar)
                                                                            <div class="checkbox">
                                                                                <h5>
                                                                                    <input style="cursor: not-allowed; color:#26B99A;" type="checkbox" class="flat" @if ($value == "true") checked="checked" @endif id="{{ $meta->metaitem_id }}">
                                                                                </h5>
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
                                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="first-name">{{ $meta->metaitem }}
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-8 col-sm-8 d-flex justify-content" style="justify-content:space-between">
                                                                    @foreach($array as $ar)
                                                                    <div class="checkbox">
                                                                        <h5>
                                                                            <input type="checkbox" class="flat" checked="checked" id="{{ $meta->metaitem_id }}" disabled="disabled">
                                                                        </h5>
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
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                            <div class="item form-group">
                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="hourly_wage">時給</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="hourly_wage" name="hourly_wage" class="form-control" value="{{ isset($salary->hourly_wage) ? $salary->hourly_wage : 0 }}" disabled="disabled">
                                                </div>
                                            </div>
                                            
                                            <div class="item form-group">
                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="basic_allowance">基本給</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="basic_allowance" name="basic_allowance" class="form-control" value="{{ isset($salary->basic_allowance) ? $salary->basic_allowance : 0 }}" disabled="disabled">
                                                </div>
                                            </div>
        
                                            <div class="item form-group">
                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="business_allowance">業務手当</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="business_allowance" name="business_allowance" class="form-control" value="{{ isset($salary->business_allowance) ? $salary->business_allowance : 0 }}" disabled="disabled">
                                                </div>
                                            </div>
        
                                            <div class="item form-group">
                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="position_allowance">役職手当</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="position_allowance" name="position_allowance" class="form-control" value="{{ isset($salary->position_allowance) ? $salary->position_allowance : 0 }}" disabled="disabled">
                                                </div>
                                            </div>
        
                                            <div class="item form-group">
                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="technical_allowance">技術手当</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="technical_allowance" name="technical_allowance" class="form-control" value="{{ isset($salary->technical_allowance) ? $salary->technical_allowance : 0 }}" disabled="disabled">
                                                </div>
                                            </div>
        
                                            <div class="item form-group">
                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="adjustment_allowance">出向調整金</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="adjustment_allowance" name="adjustment_allowance" class="form-control" value="{{ isset($salary->adjustment_allowance) ? $salary->adjustment_allowance : 0 }}" disabled="disabled">
                                                </div>
                                            </div>
                                            <div id="item_list">
                                                @if (!empty($salary->add_item))
                                                @foreach (json_decode($salary->add_item) as $label => $content)
                                                    <div class="item form-group">
                                                        {{-- <div class="col-md-3 col-sm-3"> --}}
                                                            <label class="control-label  col-md-3 col-sm-3 label-align" for="adjustment_allowance">{{ $label }}</label>
                                                        {{-- </div> --}}
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" name="update_item_content_{{$loop->iteration}}" id="update_item_content_{{$loop->iteration}}" class="form-control" value="{{ $content }}" disabled="disabled">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label  col-md-3 col-sm-3 label-align" for="monthly_total">月額合計</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="monthly_total" name="monthly_total" class="form-control" value="" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">給与履歴</button>
                                                    </div>
                                                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">給与履歴</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <ul class="list-unstyled timeline">
                                                                        @if (count($salary_history) > 0)
                                                                        @foreach ($salary_history as $item)
                                                                        <li>
                                                                            <div class="block" style="margin-left: 160px;">
                                                                                <div class="tags" style="width: 140px;">
                                                                                    <a href="javascript:void(0);" class="tag">
                                                                                        <span>{{ $item->created_at }}</span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="block_content">
                                                                                    <h2 class="title">
                                                                                        @if ($loop->iteration == 1)
                                                                                        <span class="badge badge-primary">追加</span>
                                                                                        @else
                                                                                        <span class="badge badge-warning">変更</span>
                                                                                        @endif
                                                                                    </h2>
                                                                                    <div class="byline">
                                                                                        <span>{{ $item->created_at }}</span>
                                                                                    </div>
                                                                                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                                                        <div class="panel">
                                                                                            <a class="" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{ $item->id }}" aria-expanded="true" aria-controls="collapseOne_{{ $item->id }}">
                                                                                                {{-- <p class="panel-title">この時点の情報を見る</p> --}}
                                                                                                この時点の情報を見る
                                                                                            </a>
                                                                                            <div id="collapseOne_{{ $item->id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                                                <div class="panel-body">
                                                                                                    <table class="table table-bordered">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th>#</th>
                                                                                                                <th>給与名</th>
                                                                                                                <th>金額</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <th scope="row">1</th>
                                                                                                                <td>時給</td>
                                                                                                                <td>{{ $item->hourly_wage }} 円</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th scope="row">2</th>
                                                                                                                <td>基本給</td>
                                                                                                                <td>{{ $item->basic_allowance }} 円</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th scope="row">3</th>
                                                                                                                <td>業務手当</td>
                                                                                                                <td>{{ $item->business_allowance }} 円</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th scope="row">4</th>
                                                                                                                <td>役職手当</td>
                                                                                                                <td>{{ $item->position_allowance }} 円</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th scope="row">5</th>
                                                                                                                <td>技術手当</td>
                                                                                                                <td>{{ $item->technical_allowance }} 円</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th scope="row">6</th>
                                                                                                                <td>出向調整金</td>
                                                                                                                <td>{{ $item->adjustment_allowance }} 円</td>
                                                                                                            </tr>
                                                                                                            @foreach (json_decode($item->add_item) as $item => $value)
                                                                                                            <tr>
                                                                                                                <th scope="row">{{ $loop->iteration + 6 }}</th>
                                                                                                                <td>{{ $item }}</td>
                                                                                                                <td>{{ $value }} 円</td>
                                                                                                            </tr>
                                                                                                            @endforeach
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        @endforeach
                                                                        @else
                                                                            <div class="text-center">変更履歴はありません。</div>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                                                    <a href="{{ route('company.staff_edit', $staff->id) }}" class="btn btn-primary">給与を変更</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                                <div class="row mb-4 mt-4">
                                    <div class="col-lg-6">
                                        <label class="control-label" for="fullname">部署名</label>
                                        <input type="text" name="depart" id="depart" class="form-control" disabled value="">
                                    </div>
                                    <div class="col-lg-6">
                                        <?php
                                            $job = App\Models\Job::find($staff->job_id);
                                        ?>
                                        <label class="control-label" for="fullname">役職名</label>
                                        @if (!empty($job))
                                        <input type="text" name="job" id="job" class="form-control" value="{{ $job->name }}" disabled>
                                        @else
                                        <input type="text" name="job" id="job" class="form-control" value="" disabled>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg1">変更履歴一覧</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                </div>
                                <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">変更履歴一覧</h4>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled timeline">
                                                    @if (count($staff_history) > 0)
                                                    @foreach ($staff_history as $item)
                                                    <li>
                                                        <div class="block" style="margin-left: 160px;">
                                                            <div class="tags" style="width: 140px;">
                                                                <a href="javascript:void(0);" class="tag">
                                                                    <span>{{ $item->created_at }}</span>
                                                                </a>
                                                            </div>
                                                            <div class="block_content">
                                                                <h2 class="title">
                                                                    @if ($loop->iteration == 1)
                                                                    <span class="badge badge-primary">追加</span>
                                                                    @else
                                                                    <span class="badge badge-warning">変更</span>
                                                                    @endif
                                                                </h2>
                                                                <div class="byline">
                                                                    <span>{{ $item->created_at }}</span>
                                                                </div>
                                                                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                                    <div class="panel">
                                                                        <a class="" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{ $item->id }}" aria-expanded="true" aria-controls="collapseOne_{{ $item->id }}">
                                                                            この時点の情報を見る
                                                                        </a>
                                                                        <div id="collapseOne_{{ $item->id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                            <div class="panel-body">
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>部門</th>
                                                                                            <th>役職</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php 
                                                                                            $depart_id = explode(":", $item->depart_history)[0]; 
                                                                                            $sub_depart_id = explode(":", $item->depart_history)[1];
                                                                                            $depart = App\Models\Department::find($depart_id);
                                                                                            // echo $depart;
                                                                                            $sub_depart = App\Models\Subdepartment::find($sub_depart_id);
                                                                                            $job = App\Models\Job::find($item->job_history);
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td>{{ $depart->depart }} / {{ $sub_depart->name }}</td>
                                                                                            @if (!empty($job))
                                                                                            <td>{{ $job->name }}</td>
                                                                                            @else
                                                                                            <td></td>
                                                                                            @endif
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                    @else
                                                        <div class="text-center">変更履歴はありません。</div>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                                <a href="{{ route('company.staff_edit', $staff->id) }}" class="btn btn-primary">部署を変更 </a>
                                            </div>
                                        </div>
                                    </div>
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
@section('script')
    <script>
        $(document).ready(function(){
            let hourlyWage = parseInt($("#hourly_wage").val().replace(/,/g, ''), 10);
            let basicAllowance = parseInt($("#basic_allowance").val().replace(/,/g, ''), 10);
            let businessAllowance = parseInt($("#business_allowance").val().replace(/,/g, ''), 10);
            let positionAllowance = parseInt($("#position_allowance").val().replace(/,/g, ''), 10);
            let technicalAllowance = parseInt($("#technical_allowance").val().replace(/,/g, ''), 10);
            let adjustmentAllowance = parseInt($("#adjustment_allowance").val().replace(/,/g, ''), 10);
            let itemArray = [];
            for (let i = 0; i < $("input[name^='update_item_content_']").length; i++) {
                itemArray.push(parseInt($("input[name^='update_item_content_']")[i].value.replace(/,/g, ''), 10));
            }
            let monthly_total = hourlyWage + basicAllowance + businessAllowance + positionAllowance + technicalAllowance + adjustmentAllowance + itemArray.reduce((a, b) => a + b, 0)
            $("#monthly_total").val(monthly_total.toLocaleString());
            var depart = $("#depart_id").val();
            var sub_depart = $("#sub_depart_id").val();
            $("#depart").val(depart + " / " + sub_depart);
        });
        function staff_delete(id){
            let userConfirmed = confirm("本当に削除してもよろしいですか？");
            if (userConfirmed) {
                window.location.href = "{{ route('company.staff_delete', $staff->id) }}";
            }
        }
        function staff_leave(id) {
            let userConfirmed = confirm("設定を進めてもよろしいですか？");
            if (userConfirmed) {
                $.ajax({
                    url: "{{ route('company.staff_leave') }}",
                    method: 'post',
                    data: {
                        staff_id: id
                    },
                    success: function(data) {
                        if(data == "ok"){
                            window.location.href = "{{ route('company.staff_list') }}";
                        }
                    }
                });
            }
        }
        function return_leave(id) {
            let userConfirmed = confirm("設定を進めてもよろしいですか？");
            if (userConfirmed) {
                $.ajax({
                    url: "{{ route('company.return_leave') }}",
                    method: 'post',
                    data: {
                        staff_id: id
                    },
                    success: function(data) {
                        if(data == "ok"){
                            window.location.href = "{{ route('company.staff_list') }}";
                        }
                    }
                });
            }
        }
        function retirement(id){
            let userConfirmed = confirm("設定を進めてもよろしいですか？");
            if (userConfirmed) {
                $.ajax({
                    url: "{{ route('company.staff_retirement') }}",
                    method: 'post',
                    data: {
                        staff_id: id
                    },
                    success: function(data) {
                        if(data == "ok"){
                            window.location.href = "{{ route('company.staff_list') }}";
                        }
                    }
                });
            }
        }
        function returnWork(id){
            let userConfirmed = confirm("設定を進めてもよろしいですか？");
            if (userConfirmed) {
                $.ajax({
                    url: "{{ route('company.staff_returnwork') }}",
                    method: 'post',
                    data: {
                        staff_id: id
                    },
                    success: function(data) {
                        if(data == "ok"){
                            window.location.href = "{{ route('company.staff_list') }}";
                        }
                    }
                });
            }
        }
    </script>
@endsection