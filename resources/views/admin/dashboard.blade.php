@extends('layouts.admin')

@section('content')
<style>
    .attachment img{width:150px; height:150px}
</style>
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>会社一覧</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="キー入力...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">検索</button>
                            </span>
                        </div>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="margin-left:7px">
                    <div class="row">
                        <div class="col-sm-3 mail_list_column">
                            @if (!empty($company_menu))
                                @foreach ($company_menu as $com)
                                <div class="mail_list">
                                    <div class="left">
                                        <a href="javascript:void(0);" onclick="add_star({{ $com->id }})" @if ($com->star == 1) style="color:yellow;" @endif><i class="fa fa-star"></i></a>
                                        {{-- <i class="fa fa-edit"></i> --}}
                                    </div>
                                    <div class="right">
                                        <h3>
                                            <a href="{{ route('company', $com->id) }}"@if (collect(explode('/', url()->current()))->last() == $com->id) style="color:#288cd7;" @endif>{{$com->company_name}}</a>
                                            @php
                                                $staff_count = App\Models\User::where('role', "2")->where('company_id', $com->id)->get();
                                            @endphp
                                            <small>{{ count($staff_count) }} 人</small>
                                        </h3>
                                        <?php 
                                            $companys = App\Models\User::where('company_id', $com->id)->where('role', 1)->first();
                                        ?>
                                        <p class="mb-1">代表者名 : {{ $com->seo_name }}</p>
                                        <p class="mb-1">電話番号 : @if(isset($companys->phone)) {{ $companys->phone }} @endif</p>
                                        <p class="mb-1">Email : @if(isset($companys->email)) {{ $companys->email }} @endif</p>
                                        <p class="mb-1">〒@if(isset($companys->zip1)) {{ $companys->zip1 }} @endif - @if(isset($companys->zip2)) {{ $companys->zip2 }} @endif<br>@if(isset($companys->pref)) {{ $companys->pref }} @endif @if(isset($companys->addr)) {{ $companys->addr }} @endif @if(isset($companys->str)) {{ $companys->str }} @endif</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-sm-9 mail_view">
                            <div class="inbox-body">
                                <div class="mail_heading row">
                                    <div class="col-md-8">
                                        <div class="btn-group" id="event">
                                            <a class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a onclick="company_delete({{ $company->id }})" class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                            <a href="{{ route('company_edit', $company->id) }}" class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <p class="date" id="created_at">
                                            {{ date_format($company->created_at, 'H:i A d M Y'); }}
                                        </p>
                                    </div>
                                    <div class="col-md-12" id="company_name">
                                        <h4> {{ $company->company_name }}</h4>
                                    </div>
                                </div>
                                <div class="sender-info">
                                    <div class="row">
                                        <div class="col-md-12" id="seo_name">
                                            <strong>{{ $company->seo_name }}</strong>
                                            <span>({{ $user->email }})</span> to
                                            <strong>me</strong>
                                            <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-mail" id="profile">
                                    {{ $user->profile }}
                                </div>
                                <div class="attachment">
                                    <p>
                                        <span><i class="fa fa-paperclip"></i> 8 attachments — </span>                                       
                                    </p>
                                    @isset($material)
                                    <ul>
                                        <li>
                                            @if($material->dt1 != "")
                                            <img src='{{ $material->dt1 }}' alt="img" id="dt1" />
                                            @else
                                            <img src="{{ asset('images/default.jpg')}}" alt="img" id="dt1" />
                                            @endif
                                        </li>
                                        <li>
                                            @if($material->dt2 != "")
                                            <img src='{{ $material->dt2 }}' alt="img" id="dt2" />
                                            @else
                                            <img src="{{ asset('images/default.jpg')}}" alt="img" id="dt2" />
                                            @endif
                                        </li>
                                        <li>
                                            @if($material->dt3 != "")
                                            <img src='{{ $material->dt3 }}' alt="img" id="dt3" />
                                            @else
                                            <img src="{{ asset('images/default.jpg')}}" alt="img" id="dt3" />
                                            @endif
                                        </li>
                                        <li>
                                            @if($material->dt4 != "")
                                            <img src='{{ $material->dt4 }}' alt="img" id="dt4" />
                                            @else
                                            <img src="{{ asset('images/default.jpg')}}" alt="img" id="dt4" />
                                            @endif
                                        </li>
                                        <li>
                                            @if($material->dt5 != "")
                                            <img src='{{ $material->dt5 }}' alt="img" id="dt5" />
                                            @else
                                            <img src="{{ asset('images/default.jpg')}}" alt="img" id="dt5" />
                                            @endif
                                        </li>
                                        <li>
                                            @if($material->dt6 != "")
                                            <img src='{{ $material->dt6 }}' alt="img"
                                                id="dt6" />
                                            @else
                                            <img src="{{ asset('images/default.jpg')}}" alt="img" id="dt6" />
                                            @endif
                                        </li>
                                        <li>
                                            @if($material->dt7 != "")
                                            <img src='{{ $material->dt7 }}' alt="img"
                                                id="dt7" />
                                            @else
                                            <img src="{{ asset('images/default.jpg')}}" alt="img" id="dt7" />
                                            @endif
                                        </li>
                                        <li>
                                            @if($material->dt8 != "")
                                            <img src='{{ $material->dt8 }}' alt="img"
                                                id="dt8" />
                                            @else
                                            <img src="{{ asset('images/default.jpg')}}" alt="img" id="dt8" />
                                            @endif
                                        </li>
                                    </ul>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="compose col-md-6  ">
    <div class="compose-header">
        会社情報編集
        <button type="button" class="close compose-close">
            <span>×</span>
        </button>
    </div>

    <div class="compose-body">
        <div id="alerts"></div>
        <form action="form_upload.html" class="dropzone"></form>

    </div>
    <div class="compose-footer">
        <button id="send" class="btn btn-sm btn-success" type="button">保存</button>
    </div>
</div>
<script>
// function sel_company(sel) {

//     $.ajax({
//         url: "{{ route('admin.sel_company_info') }}",
//         method: 'get',
//         data: {
//             sel: sel
//         },
//         success: function(data) {
//             console.log(data);
//             console.log(data['company']["id"]);
//             $("#company_name").html("<h4>" + data['company']['company_name'] + "</h4>");
//             $("#created_at").html(data['company']["created_at"]);
//             $("#profile").html(data['user']['profile']);

//             if (data['material']["dt1"] != "")
//                 $("#dt1").attr("src", "data:image/png;base64," + data['material']["dt1"]);
//             else
//                 $("#dt1").attr("src", "{{ asset('images/default.jpg')}}")

//             if (data['material']["dt2"] != "")
//                 $("#dt2").attr("src", "data:image/png;base64," + data['material']["dt2"]);
//             else
//                 $("#dt2").attr("src", "{{ asset('images/default.jpg')}}")

//             if (data['material']["dt3"] != "")
//                 $("#dt3").attr("src", "data:image/png;base64," + data['material']["dt3"]);
//             else
//                 $("#dt3").attr("src", "{{ asset('images/default.jpg')}}")
//             if (data['material']["dt4"] != "")
//                 $("#dt4").attr("src", "data:image/png;base64," + data['material']["dt4"]);
//             else
//                 $("#dt4").attr("src", "{{ asset('images/default.jpg')}}")
//             if (data['material']["dt5"] != "")
//                 $("#dt5").attr("src", "data:image/png;base64," + data['material']["dt5"]);
//             else
//                 $("#dt5").attr("src", "{{ asset('images/default.jpg')}}")
//             if (data['material']["dt6"] != "")
//                 $("#dt6").attr("src", "data:image/png;base64," + data['material']["dt6"]);
//             else
//                 $("#dt6").attr("src", "{{ asset('images/default.jpg')}}")
//             if (data['material']["dt7"] != "")
//                 $("#dt7").attr("src", "data:image/png;base64," + data['material']["dt7"]);
//             else
//                 $("#dt7").attr("src", "{{ asset('images/default.jpg')}}")
//             if (data['material']["dt8"] != "")
//                 $("#dt8").attr("src", "data:image/png;base64," + data['material']["dt8"]);
//             else
//                 $("#dt8").attr("src", "{{ asset('images/default.jpg')}}")

//             var seo = "<strong>" + data['user']["seo_name"] + "</strong><span>(" + data['user']["email"] +
//                 ")</span> to <strong>me</strong> <a class='sender-dropdown'><i class='fa fa-chevron-down'></i></a>";
//             $("#seo_name").html(seo);


//         }
//     });
// }
function company_delete(id) {
    if (confirm("選択した会社を削除してもよろしいですか?")) {
        $.ajax({
            url: "{{ route('company_delete') }}",
            method: 'post',
            data: {
                company_id: id
            },
            success: function(data) {
                location.href = "{{ route('admin.dashboard') }}";
            }
        });
    }
}
function add_star(id) {
    $.ajax({
        url: "{{ route('add_star') }}",
        method: 'post',
        data: {
            company_id: id
        },
        success: function(data) {
            location.reload();
            toastr.options = {
                "positionClass": "toast-bottom-left",
                "timeOut": 3000,
                "extendedTimeOut": 1000
            };

            toastr.success('success');
        }
    });
}
</script>
@endsection