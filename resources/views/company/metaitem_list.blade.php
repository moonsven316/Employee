@extends('layouts.main')
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>従業員管理項目一覧</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="margin-left:7px">
                    <div class="row">
                        <div class="col-sm-6 mail_list_column">
                            @if (!empty($metaitems))
                            @foreach ($metaitems as $dep)
                            <div class="mail_list py-2">
                                <div class="left">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <div class="right">
                                    <h3>
                                        <a href="#" onclick="sel_metaitem({{$dep->id}})">{{$dep->metaitem}}</a>
                                        @if($dep->kind == 1)
                                        <span class="badge badge-primary">テキスト</span>
                                        @endif
                                        @if($dep->kind == 2)
                                        <span class="badge badge-success">カレンダー</span>
                                        @endif                                        
                                        @if($dep->kind == 0)
                                        <span class="badge badge-danger">チェックボックス</span>
                                        @endif
                                    </h3>
                                    <p class="mb-1"> {{$dep->description}}
                                    <p class="mb-1">
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="col-sm-6 mail_view">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                        管理項目名<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <input type="text" id="metaitem" name="metaitem" required="required" class="form-control">
                                        <input type="hidden" id="sel_id" name="sel_id" value="0" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                        管理項目ID<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <input type="text" id="metaitem_id" name="metaitem_id" required="required" class="form-control">
                                        <input type="hidden" id="sel_id" name="sel_id" value="0" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                        性別<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 d-flex justify-content" style="align-items: end; justify-content:space-between">
                                        <label>
                                            <input type="radio" class=" " checked="checked" name="kind" value="1">テキスト
                                        </label>
                                        <label>
                                            <input type="radio" class=" " name="kind" value="2">カレンダー
                                        </label>
                                        <label>
                                            <input type="radio" class=" " name="kind" value="0">チェックボックス
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                        オプション<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <Textarea id="description" name="description" required="required" class="form-control"></Textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12" style="text-align:center">
                                <button class="btn btn-danger" onclick="metaitem_delete()">削除</button>
                                <button class="btn btn-primary" onclick="metaitem_update()">保存</button>
                                <button class="btn btn-success" onclick="metaitem_create()">新規登録</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var k = 0;
    function metaitem_create() {
        if ($("#metaitem").val() == "") {
            alert("「管理項目名」は必須です。");
        } else if ($("#metaitem_id").val() == ""){
            alert("「管理項目ID」は必須です。");
        } else {
            $.ajax({
                url: "{{ route('company.metaitem_add') }}",
                method: 'post',
                data: {
                    metaitem: $("#metaitem").val(),
                    description: $("#description").val(),
                    metaitem_id: $("#metaitem_id").val(),
                    kind: $("input[name=kind]").filter(":checked").val(),
                },
                success: function(data) {
                    location.href = "{{ route('company.metaitem_list') }}";
                }
            });
        }
    }

    function metaitem_update() {
        if ($("#sel_id").val() > 0) {
            if ($("#metaitem").val() == "" ||  $("#metaitem_id").val() == "") {
                alert("「管理項目名」と「管理項目ID」は必須です。");
            } else {
                $.ajax({
                    url: "{{ route('company.metaitem_save') }}",
                    method: 'post',
                    data: {
                        metaitem: $("#metaitem").val(),
                        sel_id: $("#sel_id").val(),
                        metaitem_id: $("#metaitem_id").val(),
                        kind: $("input[name=kind]").filter(":checked").val(),
                        description: $("#description").val()
                    },
                    success: function(data) {
                        location.href = "{{ route('company.metaitem_list') }}";
                    }
                });
            }
        } else {
            metaitem_create();
        }
    }

    function sel_metaitem(sel) {
        $.ajax({
            url: "{{ route('company.metaitem_sel_info') }}",
            method: 'post',
            data: {
                sel: sel
            },
            success: function(data) {
                $("#sel_id").val(data["id"]);
                $("#metaitem").val(data["metaitem"]);
                $("#description").val(data["description"]);
                $("#metaitem_id").val(data["metaitem_id"]);
                $('input[name=kind][value=' + data["kind"] + ']').prop('checked', true);
            }
        });
    }

    function metaitem_delete(){
        var result = confirm("「項目」を削除しますか？");
        if (result) {
            $.ajax({
                url: "{{ route('company.metaitem_delete') }}",
                method: 'post',
                data: {
                    sel: $("#sel_id").val()
                },
                success: function(data) {
                    location.href = "{{ route('company.metaitem_list') }}";
                }
            });
        }
    }
</script>
@endsection