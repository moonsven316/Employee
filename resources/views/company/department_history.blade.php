@extends('layouts.main')

@section('content')
<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>部署ログ</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="margin-left:7px">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="date" name="history_date" id="history_date" class="form-control" onchange="sel_history()" value="" @if (!isset($dep_history)) disabled @endif>
                        </div>
                        <div class="col-md-9">
                            @if (!isset($dep_history))
                            <div class="text-center">データなし。</div>
                            @else
                            @foreach($dep_history as $key => $values)
                            <?php $depart = App\Models\Department::find($key); ?>
                            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel">
                                    @if (isset($depart))
                                    <a class="panel-heading" role="tab" id="depart{{ $key }}" data-depart_id="" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $key }}" aria-expanded="true" aria-controls="collapseOne{{ $key }}">
                                        <h4 class="panel-title">{{ $depart->depart }}</h4>
                                        <p class="mb-1">{{ $depart->description }}</p>
                                    </a>
                                    @else
                                        <div></div>
                                    @endif
                                    @foreach($values as $value)
                                    <?php $subdepart = App\Models\Subdepartment::find($value); ?>
                                    @if (isset($subdepart))
                                    <div id="collapseOne{{ $key }}" class="panel-visible collapse in" role="tabpanel" aria-labelledby="depart{{ $key }}">
                                        <div class="panel-body">
                                            <div class="mail_list">
                                                <div class="left">
                                                    <a href="javascript:void(0);"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <div class="right">
                                                    <h3><a href="javascript:void(0);">{{ $subdepart->name }}</a></h3>
                                                    <p class="mb-1">{{ $subdepart->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <div></div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            @endif
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
        function sel_history() {
            var history_date = $('#history_date').val();
            location.href = "{{ route('company.department_history') }}?history_date=" + history_date;
        }
    </script>
@endsection