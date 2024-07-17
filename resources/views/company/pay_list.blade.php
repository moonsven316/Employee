@extends('layouts.main')

@section('content')
<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>支払い一覧</h2>
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
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">カード番号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" id="card_num" name="card_num" required="required"
                                                    data-inputmask="'mask' : '9999-9999-9999-9999'" class="form-control  ">


                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">有効期限
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 ">
                                    <input type="text" id="expired" name="expired" required="required"
                                                    data-inputmask="'mask' : '99/99'" class="form-control  ">

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">CSV
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 ">
                                    <input type="text" id="csv" name="csv" required="required"
                                                    data-inputmask="'mask' : '999'" class="form-control  ">

                                    </div>
                                </div>

                            </div>                            

                            <div class="col-md-12 col-sm-12" style="text-align:center"> 
                                <button class="btn btn-success" onclick="sheet_add()">お支払い</button>
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
    if ($("#card_num").val() == "") {
        alert("カード番号を入力する必要があります。");
        return false;
    }
    if ($("#expired").val() == "") {
        alert("有効期限を入力する必要があります。");
        return false;
    }

    if ($("#csv").val() == "") {
        alert("csvを入力する必要があります。");
        return false;
    }


    $.ajax({
        url: "{{ route('company.pay_add') }}",
        method: 'post',
        data: {
            card_num: $("#card_num").val(),
            expired: $("#expired").val(),
            csv: $("#csv").val(),
        },
        success: function(data) {
            //location.href = "{{ route('company.sheet_list') }}";
        }
    });
}

function sheet_save() {

    if ($("#sel_id").val() > 0) {
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