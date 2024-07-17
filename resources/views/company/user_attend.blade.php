@extends('layouts.main')
@section('content')
<div class="">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>従業員名 : {{ $staff->user_name }}</h2>
                <ul class="nav navbar-right panel_toolbox" style="min-width:0px">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-lg-4">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-start"><div class="float-left">所定労働日数</div></td>
                                    <td class="text-end"><div class="float-right" id="total_work_day">0日</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">平日出勤日数</div></td>
                                    <td class="text-end"><div class="float-right" id="work_day">0日</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">欠勤日数</div></td>
                                    <td class="text-end"><div class="float-right" id="absence_day">0日</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">遅刻日数</div></td>
                                    <td class="text-end"><div class="float-right" id="late_day">0日</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">早退日数</div></td>
                                    <td class="text-end"><div class="float-right" id="leave_day">0日</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">実働日数</div></td>
                                    <td class="text-end"><div class="float-right" id="current_work_day">0日</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">休日出勤日数</div></td>
                                    <td class="text-end"><div class="float-right" id="rest_day">0日</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-start"><div class="float-left">実労働時間</div></td>
                                    <td class="text-end"><div class="float-right" id="total_time">0:00</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">実深夜時間</div></td>
                                    <td class="text-end"><div class="float-right" id="night_time">0:00</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">平日労働時間</div></td>
                                    <td class="text-end"><div class="float-right" id="week_working_hours">0:00</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">平日残業時間</div></td>
                                    <td class="text-end"><div class="float-right" id="over_time">0:00</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">休日労働時間</div></td>
                                    <td class="text-end"><div class="float-right" id="holiday_work_hours">0:00</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">平日深夜時間</div></td>
                                    <td class="text-end"><div class="float-right" id="week_late_night">0:00</div></td>
                                </tr>
                                <tr>
                                    <td class="text-start"><div class="float-left">総労働時間</div></td>
                                    <td class="text-end"><div class="float-right" id="work_time">0:00</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table id="datatable-buttons2" class="table table-striped table-bordered bulk_action" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">日付</th>
                                <th class="text-center">出勤状態</th>
                                <th class="text-center">出勤～退勤時間</th>
                                <th class="text-center">休憩時間</th>
                                <th class="text-center">稼働時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0; 
                                $total_working_time = 0; 
                                $total_working_time_ = 0;
                                $workTime = App\Models\User::find($attend->user_id)->total_work_time;
                                $total_work_day = 0;
                                $work_day = 0;
                                $absence_day = 0;
                                $late_day = 0;
                                $leave_day = 0;
                                $current_work_day = 0;
                                $rest_day = 0;
                                $night_time = 0;
                                $week_working_hours = 0;
                                $week_working_hours_ = 0;
                                $over_time = 0;
                                $holiday_work_hours = 0;
                                $week_late_night = 0;
                            @endphp
                            @foreach ($dates as $date)
                                <?php
                                    $month = explode ("-", explode (":", $date)[0])[1];
                                    $day = explode ("-", explode (":", $date)[0])[2];
                                    $yo = explode (":", $date)[1];
                                    $d = "";                                        
                                    if ($yo == "Monday") {
                                        $yo = "(月)";
                                        $d = $month.'/'.$day.$yo;
                                    } elseif ($yo == "Tuesday") {
                                        $yo = "(火)";
                                        $d = $month.'/'.$day.$yo;
                                    } elseif ($yo == "Wednesday") {
                                        $yo = "(水)";
                                        $d = $month.'/'.$day.$yo;
                                    } elseif ($yo == "Thursday") {
                                        $yo = "(木)";
                                        $d = $month.'/'.$day.$yo;
                                    } elseif ($yo == "Friday") {
                                        $yo = "(金)";
                                        $d = $month.'/'.$day.$yo;
                                    } elseif ($yo == "Saturday") {
                                        $yo = "(土)";
                                        $d = $month.'/'.$day.$yo;
                                    } else {
                                        $yo = "(日)";
                                        $d = $month.'/'.$day.$yo;
                                    }
                                    $sh = json_decode($attend["s".$day-0]);
                                    $ah = json_decode($attend["a".$day-0]);
                                    $today = date('d');
                                    $attend_status = "";
                                    $sel_sheet = "";
                                    $ot_ct = "";
                                    $rs_re = "";
                                    $uptime = "";
                                    $standard_time = strtotime("18:00");
                                    if (isset($sh)) {
                                        foreach($sheets as $sheet){
                                            if($sheet->id == $sh->sh){
                                                $sel_sheet = $sheet;
                                            }
                                        }
                                        if($sel_sheet->rest_day == 1) {
                                            $total_work_day++;
                                        }
                                        if($sel_sheet->rest_day == 0) {
                                            if(isset($sel_sheet->open_time) && isset($sel_sheet->close_time)){
                                                $rest_day++;
                                            }
                                        }
                                        if ($standard_time > $sel_sheet->open_time) {
                                            $night_time += strtotime($sel_sheet->close_time) - strtotime($sel_sheet->open_time);
                                        }
                                    }
                                    if($attend["s".$day-0] == "" && $attend["a".$day-0] == ""){
                                        $attend_status = `<div></div>`;
                                    } elseif ($attend["s".$day-0] !="" && $attend["a".$day-0] == "") {
                                        if ($sh->ot != "" && $sh->ct != "") {
                                            if ($day > $today) {
                                                $attend_status = `<div></div>`;
                                            } else {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:red;' onclick='get_att_data($attend->id, $day)'>欠勤</div>";
                                                $absence_day++;
                                            }
                                        } else {
                                            $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:".$sel_sheet->sheet_color."'>".$sel_sheet->sheet_name_1."</div>";
                                        }
                                    }
                                    if (isset($ah)) {
                                        $sh_ot = strtotime($sh->ot);
                                        $sh_ct = strtotime($sh->ct);
                                        $ah_ot = strtotime($ah->ot);
                                        $ah_ct = strtotime($ah->ct);
                                        if ($ah->rd == 0 && isset($ah_ot) && isset($ah_ct)) {
                                            $holiday_work_hours += $ah_ct - $ah_ot;
                                        }
                                        if ($sh_ct > $ah_ct) {
                                            $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:pink;' onclick='get_att_data($attend->id, $day)'>早退</div>";
                                            $leave_day++;
                                        } else {
                                            if ($sh_ot < $ah_ot) {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:#ffc107;' onclick='get_att_data($attend->id, $day)'>遅刻</div>";
                                                $late_day++;
                                            } elseif ($sh_ot > $ah_ot) {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:#007bff;' onclick='get_att_data($attend->id, $day)'>出勤</div>";
                                                $work_day++;
                                            } elseif ($sh_ct > $ah_ot) {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:red;' onclick='get_att_data($attend->id, $day)'>欠勤</div>";
                                            }
                                        }
                                        if (isset($ah->ot) && isset($ah->ct)) {
                                            $st_time = explode(":", $ah->ot);
                                            $en_time = explode(":", $ah->ct);
                                            $ot_ct = $st_time[0].":".$st_time[1].'~'.$en_time[0].":".$en_time[1];
                                            $downtime_ = strtotime($sh->ct) - strtotime($sh->ot);
                                            $uptime_ = strtotime($ah->ct) - strtotime($ah->ot);
                                            $uptime = gmdate('H:i', $uptime_);
                                            if ($ah->rd == 1) {
                                                $week_working_hours_ += $uptime_;
                                                $week_working_hours = gmdate('H:i', $week_working_hours_);
                                                if ($uptime_ > $downtime_) {
                                                    $over_time += $uptime_ - $downtime_;
                                                }
                                                if ($ah_ot >= $standard_time) {
                                                    $week_late_night += $ah_ct - $ah_ot;
                                                }
                                            }
                                            $total_working_time_ += $uptime_;
                                            $total_working_time = gmdate('H:i', $total_working_time_);
                                        } else {
                                            $ot_ct = "";
                                        }
                                        if (isset($ah->rs) && isset($ah->re)) {
                                            $rs_time = explode(":", $ah->rs);
                                            $re_time = explode(":", $ah->re);
                                            $rs_re = $rs_time[0].":".$rs_time[1].'~'.$re_time[0].":".$re_time[1];
                                        } else {
                                            $rs_re = "";
                                        }
                                    }
                                    $i++;
                                ?>
                                <tr>
                                    <td class="text-center"><?=$i?></td>
                                    <td class="text-center" style="@if(strpos($d, "土") == true) color: red; @elseif(strpos($d, "日") == true) color: red; @endif"><?=$d?></td>
                                    <td class="text-center" style="padding: 0;"><?=$attend_status?></td>
                                    <td class="text-center"><?=$ot_ct?></td>
                                    <td class="text-center"><?=$rs_re?></td>
                                    <td class="text-center"><?=$uptime?></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form action="{{ route("company.attend_update") }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">勤務状況変更</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="att_id" id="att_id">
                    <input type="hidden" name="att_day" id="att_day">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="open_time">
                                出勤時間
                            </label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="time" id="open_time" name="open_time" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="close_time">
                                退勤時間
                            </label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="time" id="close_time" name="close_time" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="rest_start_time">
                                休憩開始
                            </label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="time" id="rest_start_time" name="rest_start_time" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="rest_end_time">
                                休憩終了
                            </label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="time" id="rest_end_time" name="rest_end_time" class="form-control" required>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(".dataTables_length").css('margin-bottom', '-45px');
            $("#total_time").html("{{ $workTime }}");
            $("#work_time").html("{{ $total_working_time }}");
            $("#total_work_day").html("{{ $total_work_day }}日")
            $("#work_day").html("{{ $work_day }}日");
            $("#absence_day").html("{{ $absence_day }}日");
            $("#late_day").html("{{ $late_day }}日");
            $("#leave_day").html("{{ $leave_day }}日");
            $("#current_work_day").html("{{ $work_day + $late_day + $leave_day }}日");
            $("#rest_day").html("{{ $rest_day }}日");
            $("#night_time").html("{{ gmdate('H:i', $night_time) }}");
            $("#week_working_hours").html("{{ $week_working_hours }}");
            $("#over_time").html("{{ gmdate('H:i', $over_time) }}");
            $("#holiday_work_hours").html("{{ gmdate('H:i', $holiday_work_hours) }}");
            $("#week_late_night").html("{{ gmdate('H:i', $week_late_night) }}");
        });
        function get_att_data(id, day) {
            $("#att_id").val(id);
            $("#att_day").val(day);
            var d = "{{ $today_data }}";
            $.ajax({
                url: "{{ route('company.get_attend_data') }}",
                method: 'post',
                data: {
                    'id': id,
                    'day': day,
                    'data': d
                },
                success: function(data) {
                    if (data.length != 0) {
                        $("#open_time").val(data["ot"]);
                        $("#close_time").val(data["ct"]);
                        $("#rest_start_time").val(data["rs"]);
                        $("#rest_end_time").val(data["re"]);
                    } else {
                        $("#open_time").val("");
                        $("#close_time").val("");
                        $("#rest_start_time").val("");
                        $("#rest_end_time").val("");
                    }
                    $('.bs-example-modal-sm').modal('show');
                }
            });
        }
    </script>
@endsection