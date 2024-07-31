@extends('layouts.main')
@section('css')
    <style>
        th:nth-child(1), td:nth-child(1) {
            position: -webkit-sticky;
            position: sticky !important;
            left: 0;
            background-color: #fff !important;
            z-index: 999;
        }
        th:nth-child(2), td:nth-child(2) {
            position: -webkit-sticky;
            position: sticky !important;
            left: 63px;
            background-color: #fff !important;
            z-index: 999;
        }
        th:nth-child(3), td:nth-child(3) {
            position: -webkit-sticky;
            position: sticky !important;
            left: 123px;
            background-color: #fff !important;
            z-index: 999;
        }
    </style>
@endsection
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>勤怠一覧</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" href="{{ route('company.attend_list') }}" aria-selected="false">勤怠詳細</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">シフト設定</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fadeshow active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            {{-- <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>シフト設定</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-4 d-flex">
                                                        <select id="sheet_id" name="sheet_id" class="form-control" required style="width:200px" onchange="sel_sheet()">
                                                            <option value="0">シフト選択</option>
                                                            @foreach($sheets as $sheet)
                                                            <option value="{{$sheet->id}}">{{$sheet->sheet_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div id="sheet_name_1" style="width: 38px; height: 38px; background-color: #fff; align-items: center; display: flex; justify-content: center; font-size: 17px;color: #fff;"></div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <div class="ml-2" id="sheet_info"></div>
                                                    </div>
                                                </div>
                                            </div>                            
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div id="reportrange_right" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                                        <i class="fa fa-calendar"></i>
                                                        <span id="sd_ed"></span> <b class="caret"></b>
                                                    </div>
                                                    <button class="btn btn-primary mx-3" type="button" onclick="set_sheet()">設定</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>検索項目</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <form action="{{ route('attendList.month') }}" method="post" class="form-inline">
                                                            @csrf
                                                            <div class="form-group mb-2">
                                                                <select id="year" name="year" class="form-control mr-2" style="width:90px">
                                                                    <?php 
                                                                        if(empty($_REQUEST['year'])) $_REQUEST['year'] = date("Y");
                                                                        for($y = 2023; $y < 2025; $y++){
                                                                    ?>
                                                                    <option value="{{$y}}" <?php if($_REQUEST['year'] == $y){?>selected<?php }?>>{{$y}}</option>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                
                                                            <div class="form-group mb-2">
                                                                <select id="month" name="month" class="form-control mr-2" style="width:70px">
                                                                    <?php 
                                                                        if(empty($_REQUEST['month'])) $_REQUEST['month'] = date("m");
                                                                    ?>
                                                                    @for($i = 1; $i < 13; $i++) 
                                                                    <option value="{{$i}}" <?php if($_REQUEST['month'] == $i){?>selected<?php }?>>{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                
                                                            <div class="form-group mb-2">
                                                                <label class="col-form-label mr-2">親部門</label>
                                                                <select class="form-control mr-2" name="depart" id="depart" onchange="getSubDepart()">
                                                                    <option value="0">親部門名選択</option>
                                                                    @foreach ($departments as $depart)
                                                                        <option value="{{ $depart->id }}">{{ $depart->depart }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                
                                                            <div class="form-group mb-2">
                                                                <label class="col-form-label mr-2">子部門</label>
                                                                <select class="form-control mr-2" name="sub_depart" id="sub_depart">
                                                                    
                                                                </select>
                                                            </div>
                                                
                                                            <button class="btn btn-primary mb-2" type="submit">検索</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered bulk_action" style="width:100%;">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" id="check-all" class="flat" onchange="all_staff_func()">
                                                </th>
                                                <th class="text-center">No</th>
                                                <th class="text-center" style="min-width: 100px;">名前</th>
                                                @foreach ($dates as $date)
                                                <?php
                                                    $month = explode ("-", explode (":", $date)[0])[1];
                                                    $day = explode ("-", explode (":", $date)[0])[2];
                                                    $yo = explode (":", $date)[1];
                                                    if ($yo == "Monday") {
                                                        $yo = "(月)";
                                                        echo '<th class="text-center">'.$month.'/'.$day.'<br>'.$yo.'</th>';
                                                    } elseif ($yo == "Tuesday") {
                                                        $yo = "(火)";
                                                        echo '<th class="text-center">'.$month.'/'.$day.'<br>'.$yo.'</th>';
                                                    } elseif ($yo == "Wednesday") {
                                                        $yo = "(水)";
                                                        echo '<th class="text-center">'.$month.'/'.$day.'<br>'.$yo.'</th>';
                                                    } elseif ($yo == "Thursday") {
                                                        $yo = "(木)";
                                                        echo '<th class="text-center">'.$month.'/'.$day.'<br>'.$yo.'</th>';
                                                    } elseif ($yo == "Friday") {
                                                        $yo = "(金)";
                                                        echo '<th class="text-center">'.$month.'/'.$day.'<br>'.$yo.'</th>';
                                                    } elseif ($yo == "Saturday") {
                                                        $yo = "(土)";
                                                        echo '<th class="text-center" style="color:red;">'.$month.'/'.$day.'<br>'.$yo.'</th>';
                                                    } else {
                                                        $yo = "(日)";
                                                        echo '<th class="text-center" style="color:red;">'.$month.'/'.$day.'<br>'.$yo.'</th>';
                                                    }
                                                ?>
                                                @endforeach
                                                <th class="text-center text-primary" style="min-width: 55px;">稼働<br>日数</th>
                                                <th class="text-center text-success" style="min-width: 55px;">遅刻<br>日数</th>
                                                <th class="text-center text-warning" style="min-width: 55px;">早退<br>日数</th>
                                                <th class="text-center text-danger" style="min-width: 55px;">欠勤<br>日数</th>
                                                <th class="text-center" style="min-width: 85px;">所定労働時間<br>実働時間</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $index = 1;
                                                $time = 0;
                                            ?>
                                            @foreach($attends as $att)
                                            <?php $user = App\Models\User::find($att->user_id); ?>
                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" class="flat" name="table_records" value="{{ $att->user_id }}">
                                                </td>
                                                <td class="text-center">{{ $index }}</td>
                                                <td class="text-center">{{ $att->user_name }}</td>
                                                <?php
                                                $uptime = 0;
                                                $working_day = 0;

                                                $work_count = 0;
                                                $behind_count = 0;
                                                $early_count = 0;
                                                $absent_count = 0;
                                                $hours = 0;
                                                $minutes = 0;
                                                for($i = 1; $i < $numberOfDays +1; $i++){
                                                    $txt = "";
                                                    $sh = json_decode($att["s".$i]);
                                                    $ah = json_decode($att["a".$i]);
                                                    $day = $i;
        
                                                    if (isset($ah->ot) || isset($ah->ct)) {
                                                        $uptime_ = strtotime($ah->ct) - strtotime($ah->ot);
                                                        $rs_re_ = strtotime($ah->re) - strtotime($ah->rs);
                                                        // $uptime = gmdate('H:i', $uptime_);
                                                        $uptime += $uptime_ + $time;
                                                        list($start_hours, $start_minutes) = explode(':', gmdate("H:i", $uptime_));
                                                        list($end_hours, $end_minutes) = explode(':', gmdate("H:i", $rs_re_));
                                                        $total_start_minutes = (int)$start_hours * 60 + (int)$start_minutes;
                                                        $total_end_minutes = (int)$end_hours * 60 + (int)$end_minutes;
                                                        $total_work_time_ = $total_start_minutes - $total_end_minutes;
                                                        if ($total_work_time_ > 0) {
                                                            $hours += floor($total_work_time_ / 60);
                                                            $minutes += $total_work_time_ % 60;
                                                        }
                                                    }
        
                                                    $today = date('d');
                                                    $sel_sheet = "";
                                                    if (isset($sh)) {
                                                        foreach($sheets as $sheet){
                                                            if($sheet->id == $sh->sh){
                                                                $sel_sheet = $sheet;
                                                            }
                                                        }
                                                    }
                                                    if($att["s".$i] == "" && $att["a".$i] == ""){
                                                        $txt = "<div></div>";
                                                    } elseif ($att["s".$i] !="" && $att["a".$i] == "") {
                                                        if ($sh->ot != "" || $sh->ct != "") {
                                                            // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color:red;'>欠勤</div>";
                                                            $absent_count++;
                                                        }
                                                        $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color:".$sel_sheet->sheet_color."'>".$sel_sheet->sheet_name_1."</div>";
                                                    }
                                                    if (isset($ah)) {
                                                        $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color:".$sel_sheet->sheet_color."'>".$sel_sheet->sheet_name_1."</div>";
                                                        $sh_ot = strtotime($sh->ot);
                                                        $ah_ot = strtotime($ah->ot);
                                                        $sh_ct = strtotime($sh->ct);
                                                        $ah_ct = strtotime($ah->ct);
                                                        if ($sh_ct > $ah_ct) {
                                                            if ($user->status == 1) {
                                                                // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color: rgb(225, 255, 0);'>休職</div>";
                                                            } else {
                                                                // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color:pink;'>早退</div>";
                                                                $early_count++;
                                                            }
                
                                                        } else {
                                                            if ($sh_ot < $ah_ot) {
                                                                if ($user->status == 1) {
                                                                    // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color: rgb(225, 255, 0);'>休職</div>";
                                                                } else {
                                                                    // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color:#ffc107;'>遅刻</div>";
                                                                    $behind_count++;
                                                                }
                
                                                            } elseif ($sh_ot >= $ah_ot) {
                                                                if ($user->status == 1) {
                                                                    // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color: rgb(225, 255, 0);'>休職</div>";
                                                                } else {
                                                                    // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color:#007bff;'>出勤</div>";
                                                                    $work_count++;
                                                                }
                
                                                            } elseif ($sh_ct < $ah_ot) {
                                                                if ($user->status == 1) {
                                                                    // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color: rgb(225, 255, 0);'>休職</div>";
                                                                } else {
                                                                    // $txt = "<div style='color:#fff; font-size:15px; padding: 10px 0 10px 0; background-color:red;'>欠勤</div>";
                                                                }
                                                            }
                                                        }
                
                                                        
                                                    } else {
                                                        // $txt = "<div style='color:#fff; font-size:10px; background-color:red;'>欠勤</div>";
                                                    }
                
                                                ?>
                                                <td class="text-center" style="padding: 0; cursor: pointer;" onclick="shift_set({{ $att->year }}, {{ $att->month }}, {{ $i }}, {{ $att->id }})"><?=$txt?></td>
                                                <?php } ?>
                                                @php
                                                    $hours += floor($minutes / 60);
                                                    $minutes = $minutes % 60;
                                                @endphp
                                                <td class="text-center"><?=$work_count?></td>
                                                <td class="text-center"><?=$behind_count?></td>
                                                <td class="text-center"><?=$early_count?></td>
                                                <td class="text-center"><?=$absent_count?></td>
                                                <td class="text-center" style="padding: 0;">
                                                    <?php 
                                                        if ($numberOfDays == 28) {
                                                            $workTime = App\Models\User::find($att->user_id)->first_day; 
                                                        } elseif ($numberOfDays == 29) {
                                                            $workTime = App\Models\User::find($att->user_id)->second_day; 
                                                        } elseif ($numberOfDays == 30) {
                                                            $workTime = App\Models\User::find($att->user_id)->third_day; 
                                                        } else {
                                                            $workTime = App\Models\User::find($att->user_id)->fourth_day; 
                                                        }
                                                    ?>
                                                    {{ $workTime }}時間
                                                    <br>
                                                    <hr style=" margin-top: 0px !important; margin-bottom: 0px !important;">
                                                    <?=sprintf('%02d:%02d', $hours, $minutes)?>勤務
                                                </td>
                                            </tr>
                                            <?php
                                                ++$index;
                                            ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route("company.shift_set") }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">シフト設定</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="year" id="shift_year">
                    <input type="hidden" name="month" id="shift_month">
                    <input type="hidden" name="day" id="shift_day">
                    <input type="hidden" name="user_id" id="shift_user_id">
                    <div class="col-md-12">
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-4 d-flex">
                                            <select id="sheet_id" name="sheet_id" class="form-control" required style="width:200px" onchange="sel_sheet()">
                                                <option value="0">シフト選択</option>
                                                @foreach($sheets as $sheet)
                                                <option value="{{$sheet->id}}">{{$sheet->sheet_name}}</option>
                                                @endforeach
                                            </select>
                                            <div id="sheet_name_1" style="width: 38px; height: 38px; background-color: #fff; align-items: center; display: flex; justify-content: center; font-size: 17px;color: #fff;"></div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="ml-2" id="sheet_info"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary">適用</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function shift_set(year, month, day, user_id) {
    console.log(year, month, day, user_id);
    $("#shift_year").val(year);
    $("#shift_month").val(month);
    $("#shift_day").val(day);
    $("#shift_user_id").val(user_id);
    $('.bs-example-modal-sm').modal('show');
}
function set_sheet() {
    // user_id
    var list = $("input[name='table_records']:checked").map(function () {
        return this.value;
    }).get();

    if(list.length == 0){
        alert("従業員が選択されていません。");
        return false;
    }

    if($("#sheet_id").val() == 0){
        alert("シフトが設定されていません。");
        return false;
    }
    var sd_ed = document.getElementById("sd_ed").innerHTML;
    if (sd_ed == "") {
        alert("日付を選択してください。");
    }

    console.log(
        $("#sheet_id").val(),
        sd_ed,
        $("#year").val(),
        $("#month").val(),
        $("#depart_id").val());

    var sd = sd_ed.split(" - ")[0];
    var ed = sd_ed.split(" - ")[1];
    console.log(sd);
    
    $.ajax({
        url: "{{ route('company.attend_sheet_set') }}",
        method: 'get',
        data: {
            staff: list,
            sheet: $("#sheet_id").val(),
            sd: sd,
            ed: ed
        },
        success: function(data) {
            location.href = "{{ route('company.attend_list_month') }}";
        }
    });
}

function all_staff_func() {

    if ($("#all_staff").is(":checked") == true) {

        $(".checkboxes").prop("checked", true);

    } else {

        $(".checkboxes").prop("checked", false);
    }
}

function sel_sheet() {

    if ($("#sheet_id").val() == 0) {

        $("#sheet_name_1").html("");
        $("#sheet_name_1").css({
            backgroundColor: "#fff"
        });
        $("#sheet_info").html('');

        return false;

    }

    $.ajax({
        url: "{{ route('company.sheet_sel_info') }}",
        method: 'get',
        data: {
            sel: $("#sheet_id").val()
        },
        success: function(data) {
            $("#sheet_name_1").html(data["sheet_name_1"]);
            $("#sheet_name_1").css({
                backgroundColor: data["sheet_color"]
            });

            if (data["rest_day"] == 0) {
                $("#sheet_info").html('<p style="color:' + data["sheet_color"] + '">「休日」</p>');
            } else {

                if (data["minashi"] == 0) {
                    text = '<p class="mb-1"> 出勤時間 ~ 退勤時間 : ' + data["open_time"] + ' ~ ' + data[
                        "close_time"] + '</div>';
                } else if (data["minashi"] == 1) {
                    text = '<div class="text-danger">みなし勤態</div>';
                    text += '<div class="mb-1"> 出勤時間 ~ 退勤時間 : ' + data["open_time"] + ' ~ ' + data[
                        "close_time"] + '</div>';
                } else {
                    text = '<div class="text-danger">みなし勤態</div>';
                    text += '<div class="mb-1"> 出勤時間 : ' + data["close_time"] + '</div>';
                }

                if (data["rest_apply"] == 'on') {
                    text += '<div class="mb-1"> 休憩時間 : ' + data["rest_open_time"] +`~`+ data["rest_close_time"] + '</div>';
                }

                $("#sheet_info").html(text);

            }
        }
    });
}
function getAttend() {                       
    $("#getattend").submit();
}
function getSubDepart(){
    if ($("#depart_id").val() != 0) {
        $.ajax({
            url: "{{ route('company.staff_get_sub_depart') }}",
            method: 'post',
            data: {
                depart_id: $("#depart").val()
            },
            success: function(data) {
                if (data.length === 0) {
                    $("#sub_depart").html(`<option value="0">データがありません。</option>`);
                } else {
                    var options = `<option value="0">子部門選択</option>`;
                    options += data.map(function(item) {
                        return `<option value="${item.id}">${item.name}</option>`;
                    }).join('');
                    $("#sub_depart").html(options);
                }
            }
        });
    } else {
        $("#sub_depart").html(`<option value="0">子部門選択</option>`);
    }
}
</script>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(".dataTables_length").css('margin-bottom', '-45px');
            $("#datatable-buttons_wrapper").css('padding', '0');
        });
    </script>
@endsection