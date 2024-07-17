@extends('layouts.main')
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>役職管理</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="margin-left:7px">
                    <div class="row">
                        <div class="col-sm-4 mail_list_column">
                            @foreach ($job as $job_item)
                            <a href="javascript:void(0);" onclick="get_job({{ $job_item->id }})">
                                <div class="mail_list py-2">
                                    <div class="left">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                    <div class="right">
                                        <h3>{{ $job_item->name }}</h3>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="col-sm-8 mail_view">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">役職名</label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <input type="text" id="jobName" name="jobName" required="required" class="form-control">
                                        <input type="hidden" name="jobId" id="jobId" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12" style="text-align:center">
                                <button class="btn btn-danger" onclick="jobDelete()">削除</button>
                                <button class="btn btn-primary" onclick="jobUpdate()">保存</button>
                                <button class="btn btn-success" onclick="jobCreate()">新規登録</button>
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
        function get_job(id){
            $.ajax({
                url: "{{ route('company.get_job') }}",
                method: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    $("#jobName").val(data['name']);
                    $("#jobId").val(data['id']);
                }
            });
        }
        function jobCreate(){
            if ($("#jobName").val() == "") {
                alert("「役職名」は必須です。");
            } else {
                $.ajax({
                    url: "{{ route('company.job_add') }}",
                    method: 'post',
                    data: {
                        job_name: $("#jobName").val()
                    },
                    success: function(data) {
                        window.location.href = "{{ route('company.job_create') }}";
                    }
                });
            }
        }
        function jobUpdate(){
            if ($("#jobId").val() > 0) {
                if ($("#jobName").val() == "") {
                    alert("「役職名」は必須です。");
                } else {
                    $.ajax({
                        url: "{{ route('company.job_update') }}",
                        method: 'post',
                        data: {
                            job_id: $("#jobId").val(),
                            job_name: $("#jobName").val()
                        },
                        success: function(data) {
                            window.location.href = "{{ route('company.job_create') }}";
                        }
                    });
                }
            } else {
                jobCreate();
            }
        }
        function jobDelete(){
            var result = confirm("「役職」を削除しますか？");
            if (result) {
                $.ajax({
                    url: "{{ route('company.job_delete') }}",
                    method: 'post',
                    data: {
                        job_id: $("#jobId").val()
                    },
                    success: function(data) {
                        window.location.href = "{{ route('company.job_create') }}";
                    }
                });
            }
        }
    </script>
@endsection