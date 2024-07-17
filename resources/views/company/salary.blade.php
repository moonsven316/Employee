@extends('layouts.main')
@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>給与情報</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('company.salary_create') }}">
                                    @csrf
                                    <input type="hidden" name="salary_id" id="salary_id" value="{{ isset($salary->id) ? $salary->id : 0 }}">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="hourly_wage">時給</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="hourly_wage" name="hourly_wage" class="form-control" value="{{ isset($salary->hourly_wage) ? $salary->hourly_wage : 0 }}">
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="basic_allowance">基本給</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="basic_allowance" name="basic_allowance" class="form-control" value="{{ isset($salary->basic_allowance) ? $salary->basic_allowance : 0 }}">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="business_allowance">業務手当</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="business_allowance" name="business_allowance" class="form-control" value="{{ isset($salary->business_allowance) ? $salary->business_allowance : 0 }}">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="position_allowance">役職手当</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="position_allowance" name="position_allowance" class="form-control" value="{{ isset($salary->position_allowance) ? $salary->position_allowance : 0 }}">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="technical_allowance">技術手当</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="technical_allowance" name="technical_allowance" class="form-control" value="{{ isset($salary->technical_allowance) ? $salary->technical_allowance : 0 }}">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="adjustment_allowance">出向調整金</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="adjustment_allowance" name="adjustment_allowance" class="form-control" value="{{ isset($salary->adjustment_allowance) ? $salary->adjustment_allowance : 0 }}">
                                        </div>
                                    </div>
                                    <div id="item_list">
                                        @if (!empty($salary->add_item))
                                        @foreach (json_decode($salary->add_item) as $label => $content)
                                            <div class="item form-group">
                                                <div class="col-md-2 col-sm-2"></div>
                                                <div class="col-md-1 col-sm-1">
                                                    <input type="text" name="update_item_label_{{$loop->iteration}}" id="update_item_label_{{$loop->iteration}}" class="form-control" value="{{ $label }}">
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="number" name="update_item_content_{{$loop->iteration}}" id="update_item_content_{{$loop->iteration}}" class="form-control" value="{{ $content }}">
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>

                                    <div id="add_item_list">
                
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary" id="item_add">アイテム追加</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <button class="btn btn-primary" type="reset">キャンセル</button>
                                            <button type="submit" class="btn btn-success">保存</button>
                                        </div>
                                    </div>

                                </form>
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
        var j = 1;
        $("#item_add").on('click', function(){
            var item_list = document.getElementById('add_item_list');
            var item = `<div class="item form-group">
                            <div class="col-md-2 col-sm-2"></div>
                            <div class="col-md-1 col-sm-1">
                                <input type="text" name="item_label_${j}" id="item_label_${j}" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="number" name="item_content_${j}" id="item_content_${j}" class="form-control" value="0">
                            </div>
                        </div>`;
            item_list.insertAdjacentHTML('beforeend', item);
            j++;
        });
    </script>
@endsection