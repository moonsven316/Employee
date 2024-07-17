@extends('layouts.admin')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>新規作成</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.file_upload') }}" class="dropzone" style="margin-bottom:10px">
                            @csrf
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form class="form-label-left" style="padding:0px" action="{{ route('admin.create_company_save') }}" method="POST">
                        @csrf
                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="name" name="name"
                                    placeholder="顧客ID" required="required">
                                <span class="fa fa-sort-numeric-asc form-control-feedback left"
                                    aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="email" class="form-control has-feedback-left" id="inputSuccess3"
                                    placeholder="メール" required="required" name="email" id="email">
                                @error('email')
                                    <span class="text-danger">メールはすでに取られています。</span>
                                @enderror
                                <span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="password" class="form-control has-feedback-left" id="password" name="password"
                                    placeholder="パスワード" required="required">
                                <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="company_name" name="company_name"
                                    placeholder="会社名" required="required">
                                <span class="fa fa-group form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="seo_name" name="seo_name"
                                    placeholder="代表者名" required="required">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="text" class="form-control  has-feedback-left" data-inputmask="'mask' : '(999) 999-9999'" placeholder="電話番号" id="phone" name="phone">
                                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <div class="d-flex">
                                    <input type="text" class="form-control has-feedback-left" id="zip1" name="zip1" placeholder="652" required="required" size="4" maxlength="3">                   
                                    <input type="text" class="form-control has-feedback-left" id="zip2" name="zip2" placeholder="0047" required="required" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','addr','str');" size="5" maxlength="4">                            
                                </div>
                                <span class="fa fa-filter form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="pref" name="pref" placeholder="兵庫県" required="required">
                                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="addr" name="addr" placeholder="神戸市兵庫区" required="required">
                                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="str" name="str" placeholder="下沢通" required="required">
                                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="date" class="form-control  has-feedback-left" data-inputmask="'mask' : '99/99/9999'" placeholder="生年月日" required="required" id="birthday" name="birthday">
                                {{-- <input type="text" class="form-control has-feedback-left" id="single_cal4" name="birthday" placeholder="生年月日" aria-describedby="inputSuccess2Status4"> --}}
                                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="company_num" name="company_num"
                                    placeholder="法人番号" required="required">
                                <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="employ_num" name="employ_num"
                                    placeholder="雇用保険番号" required="required">
                                <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="year_num" name="year_num"
                                    placeholder="年金番号" required="required">
                                <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="labor_num" name="labor_num"
                                    placeholder="労働保険番号" required="required">
                                <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <div><span class="fa fa-angle-double-down" aria-hidden="true"></span> 利用サービス</div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="flat" checked="checked" id="service_employ" name="service_employ"> 従業員管理
                                    </label>
                                    <label>
                                        <input type="checkbox" class="flat" checked="checked" id="service_attend" name="service_attend"> 勤怠管理
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <div><span class="fa fa-angle-double-down" aria-hidden="true"></span> 勤怠管理情報</div>
                                <div class="checkbox">
                                    <label id="labor_type0">
                                        <input type="radio" class="flat" checked name="labor_type" value="0" > 一般
                                    </label>
                                    <label id="labor_type1">
                                        <input type="radio" class="flat" name="labor_type" value="1"> 一カ月単位の変形労働制
                                    </label>
                                </div>
                            </div>

                            {{-- <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <div><span class="fa fa-angle-double-down" aria-hidden="true"></span> 1ヶ月単位の総枠</div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" class="flat" checked="checked" name="mon_total_days" value="28"> 28日
                                    </label>
                                    <label>
                                        <input type="radio" class="flat" name="mon_total_days" value="29"> 29日
                                    </label>
                                    <label>
                                        <input type="radio" class="flat" name="mon_total_days" value="30"> 30日
                                    </label>
                                    <label>
                                        <input type="radio" class="flat" name="mon_total_days" value="31"> 31日
                                    </label>
                                </div>
                            </div> --}}
                            <div id="work_time" style="display: none;">
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first_day">28日 <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="first_day" name="first_day" class="form-control " >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="second_day">29日 <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="second_day" name="second_day" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="third_day">30日 <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="third_day" name="third_day" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="fourth_day">31日 <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="fourth_day" name="fourth_day" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12">                                
                                <button class="btn btn-primary" type="reset">リセット</button>
                                <button type="submit" class="btn btn-success">保存</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#labor_type1").on('click', function(){
                console.log("show");
                $("#work_time").css('display', 'block');
            });
            $("#labor_type0").on('click', function(){
                console.log("hide");
                $("#work_time").css('display', 'none');
            });
        });
    </script>
@endsection