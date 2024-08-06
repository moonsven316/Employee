@extends('layouts.main')
@section('content')
<div class="">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>従業員名 : <a style="text-decoration: underline;" href="{{ route('company.staff_detail', $staff->id) }}">{{ $staff->user_name }}</a></h2>
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
                                {{-- <tr>
                                    <td class="text-start"><div class="float-left">休日出勤日数</div></td>
                                    <td class="text-end"><div class="float-right" id="rest_day">0日</div></td>
                                </tr> --}}
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
                <form class="col-md-8 col-sm-12 form-group row gap-2 text-end" action="{{ route("company.month_user_attend") }}" method="post">
                    @csrf
                    <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                    <select id="year" name="year" class="form-control" style="width:90px">
                        <?php 
                            if(empty($_REQUEST['year']))$_REQUEST['year'] = date("Y");
        
                            for($y = 2023; $y < 2025; $y++){
                        ?>
                        <option value="{{$y}}"
                        <?php if($_REQUEST['year'] == $y){?>selected<?php }?>
                        >{{$y}}</option>
                        <?php }?>
                    </select>
        
                    <select id="month" name="month" class="form-control" style="width:70px">
                        <?php 
                            if(empty($_REQUEST['month']))$_REQUEST['month'] = date("m");
                        ?>
                        @for($i = 1; $i < 13; $i++) 
                        <option 
                        <?php if($_REQUEST['month'] == $i){?>selected<?php }?>
        
                        value="{{$i}}"
                        >{{$i}}</option>
                        @endfor
                    </select>
                    <button class="btn btn-primary" type="submit">検索</button>
                </form>
                <div class="table-responsive mt-3">
                    <table id="datatable-buttons2" class="table table-striped table-bordered bulk_action" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">日付</th>
                                <th class="text-center">出勤状態</th>
                                <th class="text-center">シフト</th>
                                <th class="text-center">出勤時間</th>
                                <th class="text-center">退勤時間</th>
                                <th class="text-center">労働時間</th>
                                <th class="text-center">残業時間</th>
                                <th class="text-center">深夜労働時間</th>
                                <th class="text-center">休憩時間</th>
                                <th class="text-center">備考</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0; 
                                $total_working_time = 0; 
                                $total_working_time_ = 0;
                                $total_workTime = App\Models\User::find($user_id)->total_work_time;
                                $workTime = 0;
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
                                $hours = 0;
                                $minutes = 0;
                                $night_hours = 0;
                                $night_minutes = 0;
                                $over_hours = 0;
                                $over_minutes = 0;
                                $holiday_hours = 0;
                                $holiday_minutes = 0;
                                $weekday_hours = 0;
                                $weekday_minutes = 0;
                                $stampTime_ = 0;
                                $night_rs_time = 0;
                                
                            @endphp
                            <?php $user = App\Models\User::find($user_id); ?>
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
                                    $sh = json_decode($attend["s".$day]);
                                    $ah = json_decode($attend["a".$day]);
                                    $today = date('d');
                                    $attend_status = "";
                                    $sel_sheet = "";
                                    $start_time = "";
                                    $end_time = "";
                                    $rs_re = "";
                                    $uptime = "";
                                    $total_time = "";
                                    $overTime = "";
                                    $standard_time = strtotime("18:00");
                                    $nightStandardOpenTime = strtotime("22:00");
                                    $nightStandardCloseTime = strtotime("05:00");
                                    $stampTime = "";
                                    $standOpenTime = "";
                                    $standCloseTime = "";
                                    $shiftTime = "";
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
                                        if ($day > $today) {
                                            $shiftTime = `<div></div>`;
                                        } elseif(!empty($sh->ot) && !empty($sh->ct)) {
                                            $standOpenTime_ = explode(":", $sh->ot);
                                            $standOpenTime = $standOpenTime_[0].":".$standOpenTime_[1];
                                            $standCloseTime_ = explode(":", $sh->ct);
                                            $standCloseTime = $standCloseTime_[0].":".$standCloseTime_[1];
                                            $shiftTime = $standOpenTime." ~ ".$standCloseTime;
                                        } else {
                                            $shiftTime = "00:00 ~ 00:00";
                                        }
                                    }
                                    if($attend["s".$day] == "" && $attend["a".$day] == ""){
                                        $attend_status = `<div></div>`;
                                    } elseif ($attend["s".$day] !="" && $attend["a".$day] == "") {
                                        if ($sh->ot != "" && $sh->ct != "") {
                                            if ($user->status == 1) {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color: rgb(225, 255, 0);'>休職</div>";
                                            } elseif ($day > $today) {
                                                $attend_status = `<div></div>`;
                                            } else {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:red;' onclick='get_att_data($attend->id, $day)'>欠勤</div>";
                                                $absence_day++;
                                            }
                                        } else {
                                            if ($user->status == 1) {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color: rgb(225, 255, 0);'>休職</div>";
                                            } else {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:".$sel_sheet->sheet_color."'>".$sel_sheet->sheet_name_1."</div>";
                                            }
                                        }
                                    }
                                    if (isset($ah)) {
                                        $sh_ot = strtotime($sh->ot);
                                        $sh_ct = strtotime($sh->ct);
                                        $ah_ot = strtotime($ah->ot);
                                        $ah_ct = strtotime($ah->ct);

                                        // $ah_openTime = new DateTime($ah->ot);
                                        // $ah_closeTime = new DateTime($ah->ct);
                                        // $ah_time = $ah_openTime->diff($ah_closeTime);
                                        // $ah_rs_time = new DateTime($ah->rs);
                                        // $ah_re_time = new DateTime($ah->re);
                                        // $rs_time = $ah_rs_time->diff($ah_re_time);
                                        // $workTime += $ah_time->i * 60 + $ah_time->h * 3600 - $rs_time->i * 60 - $rs_time->h * 3600;

                                        if ($ah->rd == 0 && isset($ah_ot) && isset($ah_ct)) {
                                            $holiday_work_hours_ = $ah_ct - $ah_ot;
                                            $holiday_rest_hours = strtotime($ah->re) - strtotime($ah->rs);

                                            list($holiday_start_hours, $holiday_start_minutes) = explode(':', gmdate("H:i", $holiday_work_hours_));
                                            list($holiday_end_hours, $holiday_end_minutes) = explode(':', gmdate("H:i", $holiday_rest_hours));

                                            $holiday_total_start_minutes = (int)$holiday_start_hours * 60 + (int)$holiday_start_minutes;
                                            $holiday_total_end_minutes = (int)$holiday_end_hours * 60 + (int)$holiday_end_minutes;

                                            $holiday_total_work_time_ = $holiday_total_start_minutes - $holiday_total_end_minutes;

                                            if ($holiday_total_work_time_ > 0) {
                                                $holiday_hours += floor($holiday_total_work_time_ / 60);
                                                $holiday_minutes += $holiday_total_work_time_ % 60;
                                            }
                                        }
                                        if ($sh_ct > $ah_ct) {
                                            if ($user->status == 1) {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color: rgb(225, 255, 0);'>休職</div>";
                                            } else {
                                                $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:pink;' onclick='get_att_data($attend->id, $day)'>早退</div>";
                                                $leave_day++;
                                            }
                                        } else {
                                            if ($sh_ot < $ah_ot) {
                                                if ($user->status == 1) {
                                                    $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color: rgb(225, 255, 0);'>休職</div>";
                                                } else {
                                                    $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:#ffc107;' onclick='get_att_data($attend->id, $day)'>遅刻</div>";
                                                    $late_day++;
                                                }
                                            } elseif ($sh_ot >= $ah_ot) {
                                                if ($user->status == 1) {
                                                    $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color: rgb(225, 255, 0);'>休職</div>";
                                                } else {
                                                    $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:#007bff;' onclick='get_att_data($attend->id, $day)'>出勤</div>";
                                                    $work_day++;
                                                }
                                            } elseif ($sh_ct < $ah_ot) {
                                                if ($user->status == 1) {
                                                    $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color: rgb(225, 255, 0);'>休職</div>";
                                                } else {
                                                    $attend_status = "<div style='color:#fff; font-size:15px; padding: 10px 0px 10px 0px; background-color:red;' onclick='get_att_data($attend->id, $day)'>欠勤</div>";
                                                }
                                            }
                                        }
                                        if ($user->status == 1) {
                                            $shiftTime = "00:00";
                                            $start_time = "00:00";
                                            $end_time = "00:00";
                                            $total_time = "00:00";
                                            $overTime = "00:00";
                                            $stampTime = "00:00";
                                            $rs_re = "00:00";
                                        } elseif (isset($ah->ot) && isset($ah->ct)) {
                                            $start_time = $ah->ot;
                                            $end_time = $ah->ct;
                                            $downtime_ = strtotime($sh->ct) - strtotime($sh->ot);
                                            $uptime_ = strtotime($end_time) - strtotime($start_time);
                                            if ($ah->rd == 1) {
                                                $week_working_hours_ += $uptime_ - strtotime($ah->re) - strtotime($ah->rs);
                                                if ($uptime_ > $downtime_) {
                                                    list($over_start_hours, $over_start_minutes) = explode(':', gmdate("H:i", $uptime_));
                                                    list($over_end_hours, $over_end_minutes) = explode(':', gmdate("H:i", $downtime_));
                                                    $over_total_start_minutes = (int)$over_start_hours * 60 + (int)$over_start_minutes;
                                                    $over_total_end_minutes = (int)$over_end_hours * 60 + (int)$over_end_minutes;
                                                    $over_total_work_time_ = $over_total_start_minutes - $over_total_end_minutes;
                                                    if ($over_total_work_time_ > 0) {
                                                        $over_hours += floor($over_total_work_time_ / 60);
                                                        $over_minutes += $over_total_work_time_ % 60;
                                                    }
                                                }
                                                if ($ah_ot >= $standard_time) {
                                                    $week_late_night += $ah_ct - $ah_ot;
                                                }
                                            }
                                            $total_working_time_ += $uptime_;
                                            $total_working_time = gmdate('H:i', $total_working_time_);
                                            if (isset($ah->rs) && isset($ah->re)) {
                                                $rs_re_ = strtotime($ah->re) - strtotime($ah->rs);
                                                $rs_re = gmdate("H:i", $rs_re_);
                                            } else {
                                                $rs_re = "";
                                            }
                                            $_total_working_time = $uptime_ - $rs_re_;
                                            $total_time = gmdate("H:i", $_total_working_time);

                                            list($start_hours, $start_minutes) = explode(':', gmdate("H:i", $uptime_));
                                            list($end_hours, $end_minutes) = explode(':', gmdate("H:i", $rs_re_));
                                            $total_start_minutes = (int)$start_hours * 60 + (int)$start_minutes;
                                            $total_end_minutes = (int)$end_hours * 60 + (int)$end_minutes;
                                            $total_work_time_ = $total_start_minutes - $total_end_minutes;
                                            if ($total_work_time_ > 0) {
                                                $hours += floor($total_work_time_ / 60);
                                                $minutes += $total_work_time_ % 60;
                                            }

                                            if ($yo != "(土)" && $yo != "(日)") {
                                                list($weekday_start_hours, $weekday_start_minutes) = explode(':', gmdate("H:i", $uptime_));
                                                list($weekday_end_hours, $weekday_end_minutes) = explode(':', gmdate("H:i", $rs_re_));
                                                $weekday_total_start_minutes = (int)$weekday_start_hours * 60 + (int)$weekday_start_minutes;
                                                $weekday_total_end_minutes = (int)$weekday_end_hours * 60 + (int)$weekday_end_minutes;
                                                $weekday_total_work_time_ = $weekday_total_start_minutes - $weekday_total_end_minutes;
                                                if ($weekday_total_work_time_ > 0) {
                                                    $weekday_hours += floor($weekday_total_work_time_ / 60);
                                                    $weekday_minutes += $weekday_total_work_time_ % 60;
                                                }
                                            }

                                            $overTime_ = $uptime_ - $downtime_;
                                            $overTime = gmdate("H:i", $overTime_);
                                            if ($ah_ot >= $nightStandardOpenTime) {
                                                $stampTime_ = $ah_ct - $ah_ot;
                                                $night_rs_time = strtotime($ah->re) - strtotime($ah->rs);
                                                $stampTime = gmdate("H:i", $stampTime_ - $night_rs_time);
                                                if ($yo != "(土)" && $yo != "(日)") {
                                                    list($night_start_hours, $night_start_minutes) = explode(':', gmdate("H:i", $stampTime_));
                                                    list($night_end_hours, $night_end_minutes) = explode(':', gmdate("H:i", $night_rs_time));
                                                    $night_start_minutes = (int)$night_start_hours * 60 + (int)$night_start_minutes;
                                                    $night_end_minutes = (int)$night_end_hours * 60 + (int)$night_end_minutes;
                                                    $night_work_time_ = $night_start_minutes - $night_end_minutes;
                                                    if ($night_work_time_ > 0) {
                                                        $night_hours += floor($night_work_time_ / 60);
                                                        $night_minutes += $night_work_time_ % 60;
                                                    }

                                                }
                                            } else {
                                                $stampTime = "00:00";
                                            }
                                        } else {
                                            $ot_ct = "";
                                        }
                                    }
                                    $note_ = json_decode($attend["notes"]);
                                    $key_num = $i + 1;
                                    if ($key_num == "1") {
                                        $key = 'a01';
                                    } elseif ($key_num == "2") {
                                        $key = 'a02';
                                    } elseif ($key_num == "3") {
                                        $key = 'a03';
                                    } elseif ($key_num == "4") {
                                        $key = 'a04';
                                    } elseif ($key_num == "5") {
                                        $key = 'a05';
                                    } elseif ($key_num == "6") {
                                        $key = 'a06';
                                    } elseif ($key_num == "7") {
                                        $key = 'a07';
                                    } elseif ($key_num == "8") {
                                        $key = 'a08';
                                    } elseif ($key_num == "9") {
                                        $key = 'a09';
                                    } else {
                                        $key = 'a'.$key_num;
                                    }
                                    $note = $note_->$key; 
                                    $i++;
                                ?>
                                <tr>
                                    <td class="text-center"><?=$i?></td>
                                    <td class="text-center" style="@if(strpos($d, "土") == true) color: red; @elseif(strpos($d, "日") == true) color: red; @endif"><?=$d?></td>
                                    <td class="text-center" style="padding: 0;"><?=$attend_status?></td>
                                    <td class="text-center"><?=$shiftTime?></td>
                                    <td class="text-center"><?=$start_time?></td>
                                    <td class="text-center"><?=$end_time?></td>
                                    <td class="text-center"><?=$total_time?></td>
                                    <td class="text-center"><?=$overTime?></td>
                                    <td class="text-center"><?=$stampTime?></td>
                                    <td class="text-center"><?=$rs_re?></td>
                                    <td class="text-center"><?=$note?></td>
                                </tr>
                            @endforeach
                            @php
                                $hours += floor($minutes / 60);
                                $minutes = $minutes % 60;

                                $night_hours += floor($night_minutes / 60);
                                $night_minutes = $night_minutes % 60;

                                $over_hours += floor($over_minutes / 60);
                                $over_minutes = $over_minutes % 60;

                                $holiday_hours += floor($holiday_minutes / 60);
                                $holiday_minutes = $holiday_minutes % 60;

                                $weekday_hours += floor($weekday_minutes / 60);
                                $weekday_minutes = $weekday_minutes % 60;
                            @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form action="{{ route("company.attend_update") }}" method="post" id="timeForm">
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
                            <label for="fullname">シフト</label>
                            <div class="d-flex">
                                <input type="time" id="shift_open_time" class="form-control" name="shift_open_time" required="">
                                <input type="time" id="shift_close_time" class="form-control" name="shift_close_time" required="">
                            </div>
                        </div>
                    </div>
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
                    <div class="col-md-12 col-sm-12 ">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="note">
                                備考
                            </label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="text" id="note" name="note" class="form-control" required>
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
            // $("#total_time").html("{{ floor($workTime / 3600) . ':' . floor(($workTime % 3600) / 60) }}");
            $("#total_time").html("{{ sprintf('%02d:%02d', $hours, $minutes) }}");
            $("#work_time").html("{{ sprintf('%02d:%02d', $hours, $minutes) }}");
            $("#total_work_day").html("{{ $total_work_day }}日")
            // $("#total_work_day").html("{{ $total_workTime }}時間")
            $("#work_day").html("{{ $work_day + $late_day + $leave_day  }}日");
            $("#absence_day").html("{{ $absence_day }}日");
            $("#late_day").html("{{ $late_day }}日");
            $("#leave_day").html("{{ $leave_day }}日");
            $("#current_work_day").html("{{ $work_day + $late_day + $leave_day }}日");
            $("#night_time").html("{{ sprintf('%02d:%02d', $night_hours, $night_minutes) }}");
            $("#week_working_hours").html("{{ sprintf('%02d:%02d', $weekday_hours, $weekday_minutes) }}");
            $("#over_time").html("{{ sprintf('%02d:%02d', $over_hours, $over_minutes) }}");
            $("#holiday_work_hours").html("{{ sprintf('%02d:%02d', $holiday_hours, $holiday_minutes) }}");
            $("#week_late_night").html("{{ sprintf('%02d:%02d', $night_hours, $night_minutes) }}");
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
                    if (data && Object.keys(data).length !== 0) {
                        if (data.standTime) {
                            const standTime = JSON.parse(data.standTime);
                            $("#shift_open_time").val(standTime.ot);
                            $("#shift_close_time").val(standTime.ct);
                        } else {
                            $("#shift_open_time").val("");
                            $("#shift_close_time").val("");
                        }
                        if (data.stampTime) {
                            const stampTime = JSON.parse(data.stampTime);
                            $("#open_time").val(stampTime.ot);
                            $("#close_time").val(stampTime.ct);
                            const restStarttime = document.getElementById('rest_start_time');
                            const restEndtime = document.getElementById('rest_end_time');
                            const minTime = stampTime.ot;
                            const maxTime = stampTime.ct;
                            restStarttime.setAttribute('min', minTime);
                            restStarttime.setAttribute('max', maxTime);
                            restEndtime.setAttribute('min', minTime);
                            restEndtime.setAttribute('max', maxTime);

                            $("#rest_start_time").val(stampTime.rs);
                            $("#rest_end_time").val(stampTime.re);
                        } else {
                            $("#open_time").val("");
                            $("#close_time").val("");
                            $("#rest_start_time").val("");
                            $("#rest_end_time").val("");
                        }
                        if (data.note) {
                            $("#note").val(data.note);
                        } else {
                            $("#note").val("");
                        }
                    } else {
                        // Handle the case where data is empty
                        $("#shift_open_time").val("");
                        $("#shift_close_time").val("");
                        $("#open_time").val("");
                        $("#close_time").val("");
                        $("#rest_start_time").val("");
                        $("#rest_end_time").val("");
                    }
                    $('.bs-example-modal-sm').modal('show');
                }
            });
        }
        document.getElementById('timeForm').addEventListener('submit', function(event) {
            const timeValue = timeInput.value;
            const errorMessage = document.getElementById('error-message');
            
            if (timeValue < minTime || timeValue > maxTime) {
                event.preventDefault();
                errorMessage.textContent = `Please choose a time between ${minTime} and ${maxTime}.`;
            } else {
                errorMessage.textContent = '';
            }
        });
    </script>
@endsection