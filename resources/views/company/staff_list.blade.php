@extends('layouts.main')
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>従業員一覧</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">在職</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">休職中</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">退職済み</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-buttons3" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>従業員ID</th>
                                                    <th>従業員名</th>
                                                    <th>メール</th>
                                                    <th>誕生日</th>
                                                    <th>性別</th>
                                                    <th>郵便番号</th>
                                                    <th>住所</th>
                                                    <th>電話番号</th>
                                                    <th>国籍</th>
                                                    <th>入社日</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($staff_working as $staff_item)
                                                <tr>
                                                    <td>{{ $staff_item->name }}</td>
                                                    <td><a href="{{ route('company.staff_detail', $staff_item->id) }}" style="text-decoration: underline;">{{ $staff_item->user_name }}</a></td>
                                                    <td>{{ $staff_item->email }}</td>
                                                    <td>{{ $staff_item->birthday }}</td>
                                                    <td>@if ($staff_item->gender == 1) 男 @elseif($staff_item->gender == 2) 女 @else なし @endif</td>
                                                    <td>{{ $staff_item->zip1 }}-{{ $staff_item->zip2 }}</td>
                                                    <td>{{ $staff_item->pref }}{{ $staff_item->addr }}{{ $staff_item->str }}</td>
                                                    <td>{{ $staff_item->phone }}</td>
                                                    <td>{{ $staff_item->country }}</td>
                                                    <td>{{ explode(" ", $staff_item->created_at)[0] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-buttons4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>従業員ID</th>
                                                    <th>従業員名</th>
                                                    <th>メール</th>
                                                    <th>誕生日</th>
                                                    <th>性別</th>
                                                    <th>郵便番号</th>
                                                    <th>住所</th>
                                                    <th>電話番号</th>
                                                    <th>国籍</th>
                                                    <th>入社日</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($staff_leave as $staff_item)
                                                <tr>
                                                    <td>{{ $staff_item->name }}</td>
                                                    <td><a href="{{ route('company.staff_detail', $staff_item->id) }}" style="text-decoration: underline;">{{ $staff_item->user_name }}</a></td>
                                                    <td>{{ $staff_item->email }}</td>
                                                    <td>{{ $staff_item->birthday }}</td>
                                                    <td>@if ($staff_item->gender == 1) 男 @elseif($staff_item->gender == 2) 女 @else なし @endif</td>
                                                    <td>{{ $staff_item->zip1 }}-{{ $staff_item->zip2 }}</td>
                                                    <td>{{ $staff_item->pref }}{{ $staff_item->addr }}{{ $staff_item->str }}</td>
                                                    <td>{{ $staff_item->phone }}</td>
                                                    <td>{{ $staff_item->country }}</td>
                                                    <td>{{ explode(" ", $staff_item->created_at)[0] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-buttons5" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>従業員ID</th>
                                                    <th>従業員名</th>
                                                    <th>メール</th>
                                                    <th>誕生日</th>
                                                    <th>性別</th>
                                                    <th>郵便番号</th>
                                                    <th>住所</th>
                                                    <th>電話番号</th>
                                                    <th>国籍</th>
                                                    <th>入社日</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($staff_retired as $staff_item)
                                                <tr>
                                                    <td>{{ $staff_item->name }}</td>
                                                    <td><a href="{{ route('company.staff_detail', $staff_item->id) }}" style="text-decoration: underline;">{{ $staff_item->user_name }}</a></td>
                                                    <td>{{ $staff_item->email }}</td>
                                                    <td>{{ $staff_item->birthday }}</td>
                                                    <td>@if ($staff_item->gender == 1) 男 @elseif($staff_item->gender == 2) 女 @else なし @endif</td>
                                                    <td>{{ $staff_item->zip1 }}-{{ $staff_item->zip2 }}</td>
                                                    <td>{{ $staff_item->pref }}{{ $staff_item->addr }}{{ $staff_item->str }}</td>
                                                    <td>{{ $staff_item->phone }}</td>
                                                    <td>{{ $staff_item->country }}</td>
                                                    <td>{{ explode(" ", $staff_item->created_at)[0] }}</td>
                                                </tr>
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
</div>
<script>
function searchStaff(company_id) {
    const search = $("input[name=search_word]").val();

    $.ajax({
        url: "{{ route('company.search_staff') }}",
        method: 'get',
        data: {
            search: search,
            company_id: company_id
        },
        success: function(data) {
            var content = "";
            if (data.length > 0) {
                data.forEach(datum => {
                    content += `<div class="col-md-4 col-sm-4  profile_details">\n
                            <div class="well profile_view pb-2">\n
                                <div class="col-sm-12">\n
                                    <h4 class="brief"><i>正社員</i></h4>\n
                                    <div class="left col-md-7 col-sm-7">\n
                                        <h2>${datum.user_name}</h2>\n
                                        <ul class="list-unstyled">\n
                                            <li><i class="fa fa-building"></i> 住所: ${datum.address}</li>\n
                                            <li><i class="fa fa-phone"></i> 電話番号 #: ${datum.phone}</li>\n
                                            <li><i class="fa fa-calendar"></i> 入社日 : ${datum.birthday}</li>\n
                                        </ul>\n
                                    </div>\n
                                    <div class="right col-md-5 col-sm-5 text-center">\n
                                        <img src="{{ asset("avatars/man.jpg")}}" alt="" class="img-circle img-fluid">\n
                                    </div>\n
                                </div>\n
                                <div class=" profile-bottom text-center ">\n
                                    <div class=" col-sm-7 emphasis">\n
                                        <p class="ratings">\n
                                            <a>4.0</a>\n
                                            <a href="#"><span class="fa fa-star"></span></a>\n
                                            <a href="#"><span class="fa fa-star"></span></a>\n
                                            <a href="#"><span class="fa fa-star"></span></a>\n
                                            <a href="#"><span class="fa fa-star"></span></a>\n
                                            <a href="#"><span class="fa fa-star-o"></span></a>\n
                                        </p>\n
                                    </div>\n
                                    <div class=" col-sm-5 emphasis">\n
                                        <button type="button" class="btn btn-primary btn-sm px-4">\n
                                            <i class="fa fa-user"> </i> 詳細\n
                                        </button>\n
                                    </div>\n
                                </div>\n
                            </div>\n
                        </div>`;
                })
            } else {
                content = "一致する結果はありません。";
            }

            $("#content").html(content);


        }
    });
}
</script>

@endsection