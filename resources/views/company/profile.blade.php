@extends('layouts.main')
@section('css')
    <style>
    body
    {
        background-color:#f5f5f5;
    }
    .imagePreview {
        width: 150px;
        height: 150px;
        background-position: center center;
        background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
        background-color:#fff;
        background-size: cover;
        background-repeat:no-repeat;
        display: inline-block;
        /* box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2); */
        border:solid 1px rgb(108 117 125);
    }
    .imgUp
    {
        margin-bottom:15px;
    }
    .del
    {
        /* position:absolute; */
        top:0px;
        right:15px;
        width:30px;
        height:30px;
        text-align:center;
        line-height:30px;
        background-color:rgba(255,255,255,0.6);
        cursor:pointer;
    }
    .imgAdd
    {
        width:30px;
        height:30px;
        border-radius:50%;
        background-color:#007bff;
        color:#fff;
        box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
        text-align:center;
        line-height:30px;
        margin-top:0px;
        cursor:pointer;
        font-size:15px;
    }
    .img{
        width: 150px;
    }
    </style>
@endsection

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>会社概要</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="margin-left:7px">
                    <div class="row">
                        <form action="{{ route('company.company_edit_save') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                            <div class="col-sm-8 mail_view">
                                <div class="inbox-body">
                                    <div class="attachment">
                                        <p>
                                            <span><i class="fa fa-paperclip"></i>イメージは8つでなければなりません。</span>                                       
                                        </p>
                                        @if (isset($material))
                                        <ul>
                                            <li class="imgUp">
                                                @if($material->dt1 != "")
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src='{{ $material->dt1 }}' alt="img" class="img" style="width: 150px;"/>
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt1" value="" hidden>
                                                        <input type="hidden" name="dt1" class="hidden" value="{{ $material->dt1 }}">
                                                    </label>
                                                @else
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt1" value="" hidden>
                                                        <input type="hidden" name="dt1" class="hidden" value="">
                                                    </label>
                                                @endif
                                            </li>
                                            <li class="imgUp">
                                                @if($material->dt2 != "")
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src='{{ $material->dt2 }}' alt="img" class="img" style="width: 150px;"/>
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt2" value="" hidden>
                                                        <input type="hidden" name="dt2" class="hidden" value="{{ $material->dt2 }}">
                                                    </label>
                                                @else
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt2" value="" hidden>
                                                        <input type="hidden" name="dt2" class="hidden" value="">
                                                    </label>
                                                @endif
                                            </li>
                                            <li class="imgUp">
                                                @if($material->dt3 != "")
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src='{{ $material->dt3 }}' alt="img" class="img" style="width: 150px;"/>
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt3" value="" hidden>
                                                        <input type="hidden" name="dt3" class="hidden" value="{{ $material->dt3 }}">
                                                    </label>
                                                @else
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt3" value="" hidden>
                                                        <input type="hidden" name="dt3" class="hidden" value="">
                                                    </label>
                                                @endif
                                            </li>
                                            <li class="imgUp">
                                                @if($material->dt4 != "")
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src='{{ $material->dt4 }}' alt="img" class="img" style="width: 150px;"/>
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt4" value="" hidden>
                                                        <input type="hidden" name="dt4" class="hidden" value="{{ $material->dt4 }}">
                                                    </label>
                                                @else
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt4" value="" hidden>
                                                        <input type="hidden" name="dt4" class="hidden" value="">
                                                    </label>
                                                @endif
                                            </li>
                                            <li class="imgUp">
                                                @if($material->dt5 != "")
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src='{{ $material->dt5 }}' alt="img" class="img" style="width: 150px;"/>
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt5" value="" hidden>
                                                        <input type="hidden" name="dt5" class="hidden" value="{{ $material->dt5 }}">
                                                    </label>
                                                @else
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt5" value="" hidden>
                                                        <input type="hidden" name="dt5" class="hidden" value="">
                                                    </label>
                                                @endif
                                            </li>
                                            <li class="imgUp">
                                                @if($material->dt6 != "")
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src='{{ $material->dt6 }}' alt="img" class="img" style="width: 150px;"/>
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt6" value="" hidden>
                                                        <input type="hidden" name="dt6" class="hidden" value="{{ $material->dt6 }}">
                                                    </label>
                                                @else
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt6" value="" hidden>
                                                        <input type="hidden" name="dt6" class="hidden" value="">
                                                    </label>
                                                @endif
                                            </li>
                                            <li class="imgUp">
                                                @if($material->dt7 != "")
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src='{{ $material->dt7 }}' alt="img" class="img" style="width: 150px;"/>
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt7" value="" hidden>
                                                        <input type="hidden" name="dt7" class="hidden" value="{{ $material->dt7 }}">
                                                    </label>
                                                @else
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt7" value="" hidden>
                                                        <input type="hidden" name="dt7" class="hidden" value="">
                                                    </label>
                                                @endif
                                            </li>
                                            <li class="imgUp">
                                                @if($material->dt8 != "")
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src='{{ $material->dt8 }}' alt="img" class="img" style="width: 150px;"/>
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt8" value="" hidden>
                                                        <input type="hidden" name="dt8" class="hidden" value="{{ $material->dt8 }}">
                                                    </label>
                                                @else
                                                    <div class="imagePreview mb-2">
                                                        <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                            <i class="fa fa-close del"></i>
                                                        </span>
                                                        <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                    </div>
                                                    <label class="btn btn-primary w-100">
                                                        アップロード
                                                        <input type="file" class="uploadFile img" id="dt8" value="" hidden>
                                                        <input type="hidden" name="dt8" class="hidden" value="">
                                                    </label>
                                                @endif
                                            </li>
                                        </ul>
                                        @else
                                        <ul>
                                            <li class="imgUp">
                                                <div class="imagePreview mb-2">
                                                    <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                                                        <i class="fa fa-close del"></i>
                                                    </span>
                                                    <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
                                                </div>
                                                <label class="btn btn-primary w-100">
                                                    アップロード
                                                    <input type="file" class="uploadFile img" id="dt1" value="" hidden>
                                                    <input type="hidden" name="dt1" class="hidden" value="">
                                                </label>
                                            </li>
                                            <i class="fa fa-plus imgAdd"></i>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="name" name="name" placeholder="顧客ID" required="required" value="{{ $user->name }}">
                                    <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="email" class="form-control has-feedback-left" id="inputSuccess3" placeholder="メール" required="required" name="email" id="email" value="{{ $user->email }}">
                                    <span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                {{-- <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="password" class="form-control has-feedback-left" id="password" name="password"
                                        placeholder="パスワード" required="required">
                                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="password" class="form-control has-feedback-left" id="password_confirm" name="password_confirm"
                                        placeholder="パスワード確認" required="required">
                                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                                </div> --}}

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="company_name" name="company_name" placeholder="会社名" required="required" value="{{ $company->company_name }}">
                                    <span class="fa fa-group form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="seo_name" name="seo_name" placeholder="代表者名" required="required" value="{{ $company->seo_name }}">
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="text" class="form-control  has-feedback-left" data-inputmask="'mask' : '(999) 999-9999'" placeholder="電話番号" id="phone" name="phone" value="{{ $user->phone }}">
                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <div class="d-flex">
                                        <input type="tel" class="form-control has-feedback-left" id="zip1" name="zip1" placeholder="652" required="required" value="{{ $user->zip1 }}" size="4" maxlength="3">                                 
                                        <input type="tel" class="form-control has-feedback-left" id="zip2" name="zip2" placeholder="0042" required="required" value="{{ $user->zip2 }}" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','addr','str');">                                 
                                    </div>
                                    <span class="fa fa-filter form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="pref" name="pref" placeholder="住所" required="required" value="{{ $user->pref }}">
                                    <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="addr" name="addr" placeholder="住所" required="required" value="{{ $user->addr }}">
                                    <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="str" name="str" placeholder="住所" required="required" value="{{ $user->str }}">
                                    <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="date" class="form-control  has-feedback-left" data-inputmask="'mask' : '99/99/9999'" placeholder="生年月日" required="required" id="birthday" name="birthday" value="{{ $user->birthday }}">
                                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="company_num" name="company_num" placeholder="法人番号" required="required" value="{{ $company->company_num }}">
                                    <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="employ_num" name="employ_num" placeholder="雇用保険番号" required="required" value="{{ $company->employ_num }}">
                                    <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="year_num" name="year_num" placeholder="年金番号" required="required" value="{{ $company->year_num }}">
                                    <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="labor_num" name="labor_num" placeholder="労働保険番号" required="required" value="{{ $company->labor_num }}">
                                    <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                
                                <div class="col-md-12 col-sm-12">                                
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
</div>
@endsection

@section('script')
<script>
    var i = 1;
    $(".imgAdd").click(function(){
        if (i > 7) return;
        $(this).closest(".row").find('.imgAdd').before(`
        <li class="imgUp">
            <div class="imagePreview mb-2">
                <span class="badge bg-primary" style="margin-bottom: -40px; position: absolute;">
                    <i class="fa fa-close del"></i>
                </span>
                <img src="{{ asset('images/default.jpg')}}" alt="img" class="img" />
            </div>
            <label class="btn btn-primary w-100">
                アップロード
                <input type="file" class="uploadFile img" id="dt${i+1}" value="" hidden>
                <input type="hidden" name="dt${i+1}" class="hidden" value="">
            </label>
        </li>`);
        i++;
    });
    $(document).on("click", "i.del" , function() {
        $(this).parent().parent().parent().remove();
    });
    $(function() {
        $(document).on("change",".uploadFile", function()
        {
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return;
    
            if (/^image/.test( files[0].type)){
                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onloadend = function(){
                    // alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                    uploadFile.closest(".imgUp").find('.imagePreview').find('.img').attr('src', ""+this.result+"");
                    uploadFile.closest(".imgUp").find('.hidden').attr("value", ""+this.result+"");
                }
            }
        });
    });
</script>
@endsection