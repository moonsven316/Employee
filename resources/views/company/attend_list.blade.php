@extends('layouts.main')
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
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">日表示</a>
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">シフト設定</a> --}}
                            <a class="nav-link" id="profile-tab" href="{{ route('company.attend_list_month') }}" aria-selected="false">シフト設定</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-lg-12">
                                {{-- <form action="{{ route('company.attend_search_day') }}" method="post" id="dateSearch">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2 col-2 ">本日</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="date" class="form-control" value="{{ $today }}" id="searchDate" name="searchDate" onchange="dateSearch()">
                                        </div>
                                    </div>
                                </form> --}}
                                <form action="{{ route('company.attend_search_depart') }}" method="post" id="getattend">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-3 col-3 ">親部門</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <select class="form-control" name="depart" id="depart" onchange="getSubDepart()">
                                                        <option value="0">親部門名選択</option>
                                                        @foreach ($departments as $depart)
                                                            <option value="{{ $depart->id }}">{{ $depart->depart }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-3 col-3 ">子部門</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <select class="form-control" name="sub_depart" id="sub_depart" onchange="getAttend()">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="datatable-buttons1" class="table table-striped table-bordered bulk_action" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">従業員ID</th>
                                                <th class="text-center">氏名</th>
                                                <th class="text-center">出勤状態</th>
                                                <th class="text-center">休憩、稼働時間</th>
                                                <th class="text-center">電話番号</th>
                                                <th class="text-center">新規追加</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $index = 1;
                                            ?>
                                            @foreach($attends as $att)
                                            <tr class="even pointer">
                                                <td class="text-center">{{ $index }}</td>
                                                <?php $user = App\Models\User::find($att->user_id); ?>
                                                <td class="text-center"> @if(isset($user->name)) {{ $user->name }} @endif </td>
                                                <td class="text-center">{{ $att->user_name }}</td>
                                                <?php 
                                                    $today = date('d');
                                                    $sh = json_decode($att["s".$today]);
                                                    $ah = json_decode($att["a".$today]);
                                                    $sel_sheet = "";
                                                    if (isset($sh)) {
                                                        foreach($sheets as $sheet){
                                                            if($sheet->id == $sh->sh){
                                                                $sel_sheet = $sheet;
                                                            }
                                                        }
                                                    }
                                                    if($att["s".$today] == "" && $att["a".$today] == "") {

                                                        echo '<td class="text-center"></td>';
                                                        echo '<td class="text-center"></td>';

                                                    } elseif ($att["s".$today] !="" && $att["a".$today] == "") {

                                                        if ($sh->ot != "" || $sh->ct != "") {

                                                            echo '<td class="text-center" style="background-color: red; padding: 0;"><div style="color:#fff; font-size:15px; background-color:red;" class="py-2">欠勤</div></td>';
                                                            echo '<td class="text-center"></td>';

                                                        } else {

                                                                echo "<td class='text-center' style='background-color: ".$sel_sheet->sheet_color."; padding: 0;'><div style='color:#fff; font-size:15px; background-color:".$sel_sheet->sheet_color."' class='py-2'>".$sel_sheet->sheet_name_1."</div></td>";
                                                                echo '<td class="text-center"></td>';

                                                        }
                                                    }
                                                    if (isset($ah)) {
                                                        $sh_ot = strtotime($sh->ot);
                                                        $ah_ot = strtotime($ah->ot);
                                                        $sh_ct = strtotime($sh->ct);
                                                        $ah_ct = strtotime($ah->ct);
                                                        if ($sh_ct > $ah_ct) {

                                                            echo '<td class="text-center" style="background-color: pink; padding: 0;"><div style="color:#fff; font-size:15px; background-color:pink;" class="py-2">早退</div></td>';
                                                            echo '<td class="text-center"></td>';
                
                                                        } else {
                                                            if ($sh_ot < $ah_ot) {
                                                                
                                                                echo '<td class="text-center" style="background-color: #ffc107; padding: 0;"><div style="color:#fff; font-size:15px; background-color:#ffc107;" class="py-2">遅刻</div></td>';
                                                                echo '<td class="text-center"></td>';
                
                                                            } elseif ($sh_ot > $ah_ot) {
                
                                                                echo '<td class="text-center" style="background-color: #007bff; padding: 0;"><div style="color:#fff; font-size:15px; background-color:#007bff;" class="py-2">出勤</div></td>';
                                                                echo '<td class="text-center">'.$ah->rs.'~'.$ah->re.', '.$ah->ot.'~'.$ah->ct.'</td>';
                
                                                            } elseif ($sh_ct > $ah_ot) {
                
                                                                echo '<td class="text-center" style="background-color: red; padding: 0;"><div style="color:#fff; font-size:15px; background-color:red;" class="py-2">欠勤</div></td>';
                                                                echo '<td class="text-center"></td>';
                
                                                            }
                                                        }  
                                                    }
                                                ?>
                                                <td class="text-center"> @if(isset($user->phone)) {{ $user->phone }} @endif </td>
                                                <td class="text-center"> <a href="{{ route('company.user_attend', $att->user_id) }}">詳細</a></td>
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
<script>
    function set_sheet() {
        // user_id
        var list = $("input[name='table_records']:checked").map(function () {
            return this.value;
        }).get();
        // console.log(list);

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
                location.href = "{{ route('company.attend_list') }}";
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
                        text += '<div class="mb-1"> 休憩時間 : : ' + data["rest_time"] + '</div>';
                    }

                    $("#sheet_info").html(text);

                }
            }
        });
    }
</script>

@endsection
@section('script')
    <script>
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