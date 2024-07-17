@extends('layouts.main')
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>勤務時間設定</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('company.working_time_set_save') }}">
                        @csrf
                        <input type="hidden" name="time_id" value="{{ $time->id }}">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first_day">28日 <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="number" id="first_day" name="first_day" required="required" class="form-control " value="{{ $time->first_day }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="second_day">29日 <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="number" id="second_day" name="second_day" required="required" class="form-control" value="{{ $time->second_day }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="third_day">30日 <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="number" id="third_day" name="third_day" required="required" class="form-control" value="{{ $time->third_day }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="fourth_day">31日 <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="number" id="fourth_day" name="fourth_day" required="required" class="form-control" value="{{ $time->fourth_day }}">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button class="btn btn-primary" type="reset">リセット</button>
                                <button type="submit" class="btn btn-success">保存</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection