@extends('layouts.main')

@section('content')
<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>役職履歴</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="margin-left:7px">
                    <div class="row">
                        <div class="col-md-3">
                            <select name="staff" id="staff" class="form-control" onchange="sel_staff()">
                                <option value="0"></option>
                                @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" @if (isset($staff_id)) @if ($staff_id == $staff->id) selected @endif @endif >{{ $staff->user_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-9 mail_list_column">
                        @if (!empty($history))
                        @foreach ($history as $item)
                            <div class="mail_list">
                                <div class="col-sm-4">
                                    <?php
                                        $job = App\Models\Job::find($item->history); 
                                    ?>
                                    部署名 : {{ $job->name }}
                                </div>
                                <div class="col-sm-4">
                                    変更日 : {{ $item->created_at }}
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
        function sel_staff() {
            var id = $('#staff').val();
            if(id != 0){
                location.href = "{{ route('company.job_history') }}?staff_id=" + id;
            }
        }
    </script>
@endsection