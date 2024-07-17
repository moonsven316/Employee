@extends('layouts.main')

@section('content')
<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>シフト一覧</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="margin-left:7px">
                    <div class="row">
                        <div class="col-sm-4 mail_list_column">


                            <?php
                                // var_export($users);
                                ?>
                            @if (!empty($sheets))
                            @foreach ($sheets as $sheet)
                            <div class="mail_list">
                                <div class="left">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <div class="right">
                                    <h3>
                                        <a href="#" onclick="sel_sheet({{$sheet->id}})">{{$sheet->sheet_name}}</a>
                                        <span class="badge text-white"
                                            style="background-color:{{$sheet->sheet_color}}">{{$sheet->sheet_name_1}}</span>
                                    </h3>
                                    @if($sheet->rest_day == 0)
                                    <p class="mb-1 text-danger">「休日」</p>
                                    @else
                                    @if($sheet->minashi == 0)
                                    <p class="mb-1"> 出勤時間 ~ 退勤時間 :<br>{{$sheet->open_time}} ~ {{$sheet->close_time}}</p>
                                    @else
                                    <div class="text-danger">みなし勤態</div>
                                    @if($sheet->minashi == 0)
                                    <p class="mb-1"> 出勤時間 ~ 退勤時間 :<br>{{$sheet->open_time}} ~ {{$sheet->close_time}}</p>
                                    @else
                                    <p class="mb-1"> 出勤時間 : {{$sheet->open_time}}</p>
                                    @endif
                                    @endif

                                    @endif

                                    @if($sheet->rest_apply == 'on')
                                    <p class="mb-1">
                                        休憩時間 :
                                        <br>
                                        {{$sheet->rest_time}}
                                    </p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @endif

                        </div>
                        <!-- /MAIL LIST -->

                        <!-- CONTENT MAIL -->
                        <div class="col-sm-8 mail_view">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">シフト名
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" id="sheet_name" name="sheet_name" required="required"
                                            class="form-control  ">

                                        <input type="hidden" id="sel_id" name="sel_id" value="0" class="form-control  ">

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">略称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 ">
                                        <input type="text" id="sheet_name_1" name="sheet_name_1" required="required"
                                            class="form-control  ">

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">

                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">色
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9  ">
                                        <div class="input-group demo2">
                                            <input type="text" value="#e01ab5" class="form-control" id="sheet_color"
                                                name="sheet_color" />
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">休日
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 d-flex justify-content">
                                        <select id="rest_day" name="rest_day" class="form-control" required>
                                            <option value="0">「休日」</option>
                                            <option value="1">「平日」</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">出勤時間
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="time" id="open_time" name="open_time" required="required"
                                            class="form-control  ">

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">退勤時間
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="time" id="close_time" name="close_time" required="required"
                                            class="form-control  ">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">休憩時間
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-5 col-sm-5 ">
                                        <Textarea id="rest_time" name="rest_time" class="form-control  "></Textarea>
                                    </div>
                                    <div class="col-md-5col-sm-5 ml-2">
                                        ※休憩時間入力<br>
                                        11:00~12:00<br>
                                        15:00~16:00
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">自動休憩
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 d-flex justify-content">

                                        <label class="">
                                            <div class="icheckbox_flat-green checked" style="position: relative;">
                                                <input type="checkbox" class="flat" checked="checked" name='rest_apply'
                                                    id='rest_apply' style="position: absolute; opacity: 0;">
                                                <ins class="iCheck-helper"
                                                    style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                            </div>

                                        </label>
                                        上記の休息時間を自動休息とする
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">みなし勤態
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 justify-content">

                                        <input type="radio" name='minashi' checked="checked" value='0'>
                                        なし
                                        <br>

                                        <input type="radio" name='minashi' value='1'>
                                        このシフトパターンをみなし勤態とする
                                        <br>

                                        <input type="radio" name='minashi' value='2'>
                                        出勤時間のみをみなし出勤時間として利用`
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">退勤時間
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 d-flex justify-content">

                                        <label class="">
                                            <div class="icheckbox_flat-green checked" style="position: relative;">
                                                <input type="checkbox" class="flat" checked="checked" name='ch_sheet'
                                                    id='ch_sheet' style="position: absolute; opacity: 0;">
                                                <ins class="iCheck-helper"
                                                    style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                            </div>

                                        </label>
                                        子グループにも同時に作成する
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 col-sm-12" style="text-align:center">
                                <button class="btn btn-danger">削除</button>
                                <button class="btn btn-primary" onclick="sheet_save()">保存</button>
                                <button class="btn btn-success" onclick="sheet_add()">新規登録</button>
                            </div>
                        </div>

                        <!-- /CONTENT MAIL -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var k = 0;

function sheet_add() {
    if ($("#sheet_name").val() == "") {
        alert("シフト名を入力する必要があります。");
        return false;
    }
    if ($("#sheet_name_1").val() == "") {
        alert("シフト略称を入力する必要があります。");
        return false;
    }

    $.ajax({
        url: "{{ route('company.sheet_add') }}",
        method: 'post',
        data: {
            sheet_name: $("#sheet_name").val(),
            sheet_name_1: $("#sheet_name_1").val(),
            sheet_color: $("#sheet_color").val(),
            rest_day: $("#rest_day").val(),

            open_time: $("#open_time").val(),
            close_time: $("#close_time").val(),
            rest_time: $("#rest_time").val(),
            rest_apply: $("#rest_apply").val(),

            minashi: $("input[name=minashi]").filter(":checked").val(),
            ch_sheet: $("#ch_sheet").val(),

        },
        success: function(data) {
            location.href = "{{ route('company.sheet_list') }}";
        }
    });
}

function sheet_save() {
    if ($("#sel_id").val() == 99999) {
        alert("このシートは標準資料のため変更できません。");
    }else if ($("#sel_id").val() > 0) {
        if ($("#sheet_name").val() == "") {
            alert("シフト名を入力する必要があります。");
            return false;
        }
        if ($("#sheet_name_1").val() == "") {
            alert("シフト略称を入力する必要があります。");
            return false;
        }

        $.ajax({
            url: "{{ route('company.sheet_save') }}",
            method: 'post',
            data: {
                sheet_name: $("#sheet_name").val(),
                sheet_name_1: $("#sheet_name_1").val(),
                sheet_color: $("#sheet_color").val(),
                rest_day: $("#rest_day").val(),
                sel_id: $("#sel_id").val(),
                open_time: $("#open_time").val(),
                close_time: $("#close_time").val(),
                rest_time: $("#rest_time").val(),
                rest_apply: $("#rest_apply").val(),
                minashi: $("input[name=minashi]").filter(":checked").val(),
                ch_sheet: $("#ch_sheet").val(),

            },
            success: function(data) {
               location.href = "{{ route('company.sheet_list') }}";
            }
        });

    } else {
        depart_add();
    }
}

function sel_sheet(sel) {

    $.ajax({
        url: "{{ route('company.sheet_sel_info') }}",
        method: 'get',
        data: {
            sel: sel
        },
        success: function(data) {
            // location.href = "{{ route('company.department_list') }}";
            $("#sel_id").val(data["id"]);
            $("#sheet_name").val(data["sheet_name"]);
            $("#sheet_name_1").val(data["sheet_name_1"]);
            $("#sheet_color").val(data["sheet_color"]);

            $("#rest_day").val(data["rest_day"]);
            $("#open_time").val(data["open_time"]);
            $("#close_time").val(data["close_time"]);
            $("#rest_time").val(data["rest_time"]);

            $("#rest_apply").val(data["rest_apply"]);

            $("#ch_sheet").val(data["ch_sheet"]);
            $('input[name=minashi][value=' + data["minashi"] + ']').prop('checked', true);

        }
    });
}
</script>
@endsection