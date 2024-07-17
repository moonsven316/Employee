@extends('layouts.main')
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>部署一覧</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="margin-left:7px">
                    <div class="row">
                        <div class="col-sm-6 mail_list_column">
                            @if (!empty($departments))
                            @foreach ($departments as $dep)
                            <div class="mail_list">
                                <div class="left">
                                    <a href="javascript:void(0);" onclick="sel_depart({{$dep->id}})"><i class="fa fa-edit"></i></a>
                                </div>
                                <div class="right">
                                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <a class="panel-heading" role="tab" id="depart{{ $dep->id }}" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $dep->id }}" aria-expanded="true" aria-controls="collapseOne{{ $dep->id }}">
                                                <h4 class="panel-title" onclick="sel_depart({{$dep->id}})">{{ $dep->depart }}</h4>
                                                <p class="mb-1"> {{$dep->description}} </p>
                                            </a>
                                            <div id="collapseOne{{ $dep->id }}" class="panel-visible collapse in" role="tabpanel" aria-labelledby="depart{{ $dep->id }}">
                                                <div class="panel-body px-3">
                                                    @foreach ($subdepartment as $sub_depart)
                                                        @if ($sub_depart->depart_id == $dep->id)
                                                            <div class="mail_list">
                                                                <div class="left">
                                                                    <a href="javascript:void(0);" onclick="sel_sub_depart({{ $sub_depart->id }})"><i class="fa fa-edit"></i></a>
                                                                </div>
                                                                <div class="right">
                                                                    <h3 onclick="sel_sub_depart({{ $sub_depart->id }})"><a href="javascript:void(0);">{{ $sub_depart->name }}</a></h3>
                                                                    <p class="mb-1">{{ $sub_depart->description }}</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="col-sm-6 mail_view">
                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="department-tab" data-toggle="tab" href="#department" role="tab" aria-controls="department" aria-selected="true">親部門</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="subdepartment-tab" data-toggle="tab" href="#subdepartment" role="tab" aria-controls="subdepartment" aria-selected="false">子部門</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="department" role="tabpanel" aria-labelledby="department-tab">
                                    <div class="col-md-12 col-sm-12 ">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">部署名
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 ">
                                                <input type="text" id="depart" name="depart" required="required" class="form-control">
                                                <input type="hidden" id="sel_id" name="sel_id" value="0" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">説明
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 ">
                                                <Textarea id="description" name="description" required="required" class="form-control"></Textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12" style="text-align:center">
                                        <button class="btn btn-danger" onclick="depart_delete()">削除</button>
                                        <button class="btn btn-primary" onclick="depart_update()">更新</button>
                                        <button class="btn btn-success" onclick="depart_create()">新規追加</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="subdepartment" role="tabpanel" aria-labelledby="subdepartment-tab">
                                    <div class="col-md-12 col-sm-12 ">
                                        <div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">親部門
                                                <span class="required">*</span>
                                            </label>
											<div class="col-md-8 col-sm-8 ">
												<select class="select2_single form-control" tabindex="-1" id="de_id" name="de_id">
													<option value="0">親部門選択</option>
													@foreach ($departments as $depart)
                                                    <option value="{{ $depart->id }}">{{ $depart->depart }}</option>
                                                    @endforeach
												</select>
											</div>
										</div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">部署名
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 ">
                                                <input type="text" id="sub_depart" name="sub_depart" required="required" class="form-control">
                                                <input type="hidden" name="sub_depart_id" id="sub_depart_id" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">説明
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 ">
                                                <Textarea id="sub_description" name="sub_description" required="required" class="form-control"></Textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12" style="text-align:center">
                                        <button class="btn btn-danger" onclick="sub_depart_delete()">削除</button>
                                        <button class="btn btn-primary" onclick="sub_depart_update()">保存</button>
                                        <button class="btn btn-success" onclick="sub_depart_create()">新規登録</button>
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
<script>
    function depart_create() {
        var depart = $("#depart").val();
        var description = $("#description").val();
        if (depart == "") {
            alert('「部署名」を入力してください。');
        } else if (description == "") {
            alert('「説明」を入力してください。');
        } else {
            $.ajax({
                url: "{{ route('company.department_add') }}",
                method: 'post',
                data: {
                    depart: $("#depart").val(),
                    description: $("#description").val()
                },
                success: function(data) {
                    location.href = "{{ route('company.department_list') }}";
                }
            });
        }
    }

    function depart_update() {
        var depart = $("#depart").val();
        var description = $("#description").val();
        if ($("#sel_id").val() > 0) {
            if (depart == "") {
                alert('「部署名」を入力してください。');
            } else if (description == "") {
                alert('「説明」を入力してください。');
            } else {
                $.ajax({
                    url: "{{ route('company.department_save') }}",
                    method: 'post',
                    data: {
                        depart: $("#depart").val(),
                        sel_id: $("#sel_id").val(),
                        description: $("#description").val()
                    },
                    success: function(data) {
                        location.href = "{{ route('company.department_list') }}";
                    }
                });
            }
        } else {
            depart_create();
        }
    }

    function depart_delete() {
        if($("#sel_id").val() == 0) {
            alert("「部署」を選択してください。");
        } else {
            var result = confirm("「部署」を削除しますか？");
            if (result) {
                $.ajax({
                    url: "{{ route('company.department_delete') }}",
                    method: 'post',
                    data: {
                        depart_id: $("#sel_id").val()
                    },
                    success: function(data) {
                        location.href = "{{ route('company.department_list') }}";
                    }
                });
            }
        }
    }

    function sel_depart(sel){
        $("#department-tab").attr('aria-selected', 'ture');
        $("#department-tab").addClass('active');
        $("#department").addClass('show active');
        $("#subdepartment-tab").attr('aria-selected', 'false');
        $("#subdepartment-tab").removeClass('active');
        $("#subdepartment").removeClass('show active');
        $.ajax({
            url: "{{ route('company.department_sel_info') }}",
            method: 'post',
            data: {
                sel: sel
            },
            success: function(data) {
                $("#sel_id").val(data["id"]);
                $("#depart").val(data["depart"]);
                $("#description").val(data["description"]);

            }
        });
    }

    function sub_depart_create() {
        var de_id = $("#de_id").val();
        var sub_depart = $("#sub_depart").val();
        var sub_description = $("#sub_description").val();
        if (de_id == 0) {
            alert("「親部門」を選択してください。");
        } else if (sub_depart == "") {
            alert("「部署名」を入力してください。");
        } else if (sub_description == "") {
            alert('「説明」を入力してください。');
        } else {
            $.ajax({
                url: "{{ route('company.sub_department_add') }}",
                method: 'post',
                data: {
                    de_id: de_id,
                    depart: sub_depart,
                    description: sub_description
                },
                success: function(data) {
                    location.href = "{{ route('company.department_list') }}";
                }
            });
        }
    }

    function sel_sub_depart(sub_id) {
        $("#department-tab").attr('aria-selected', 'false');
        $("#department-tab").removeClass('active');
        $("#department").removeClass('show active');
        $("#subdepartment-tab").attr('aria-selected', 'true');
        $("#subdepartment-tab").addClass('active');
        $("#subdepartment").addClass('show active');
        $.ajax({
            url: "{{ route('company.sub_department_sel_info') }}",
            method: 'post',
            data: {
                sub_id: sub_id
            },
            success: function(data) {
                console.log(data);
                $("#de_id").val(data["depart_id"]);
                $("#sub_depart").val(data["name"]);
                $("#sub_depart_id").val(data["id"]);
                $("#sub_description").val(data["description"]);
            }
        });
    }

    function sub_depart_update() {
        var de_id = $("#de_id").val();
        var sub_depart = $("#sub_depart").val();
        var sub_description = $("#sub_description").val();

        if($("#sub_depart_id").val() > 0) {
            if (de_id == 0) {
                alert("「親部門」を選択してください。");
            } else if (sub_depart == "") {
                alert("「部署名」を入力してください。");
            } else if (sub_description == "") {
                alert('「説明」を入力してください。');
            } else {
                $.ajax({
                    url: "{{ route('company.sub_department_save') }}",
                    method: 'post',
                    data: {
                        de_id: de_id,
                        sub_depart: sub_depart,
                        sub_depart_id: $("#sub_depart_id").val(),
                        description: sub_description
                    },
                    success: function(data) {
                        location.href = "{{ route('company.department_list') }}";
                    }
                });
            }
        } else {
            sub_depart_create();
        }
    }

    function sub_depart_delete() {
        if($("#sub_depart_id").val() == 0) {
            alert("「部署」を選択してください。");
        } else {
            var result = confirm("「部署」を削除しますか？");
            if (result) {
                $.ajax({
                    url: "{{ route('company.sub_department_delete') }}",
                    method: 'post',
                    data: {
                        sub_depart_id: $("#sub_depart_id").val()
                    },
                    success: function(data) {
                        location.href = "{{ route('company.department_list') }}";
                    }
                });
            }
        }
    }
</script>
@endsection