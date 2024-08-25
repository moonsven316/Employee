@extends('top.layouts.app')
@section('content')
<!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
    @include('top.layouts.topmenu')
    @include('top.layouts.childcarousel')
</div>
<!-- Navbar & Carousel End -->
<!-- Pricing Plan Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">料金プラン</h5>
            <h1 class="mb-0">勤怠管理に必要な機能提供</h1>
        </div>
        <div class="row g-0">
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                <div class="bg-light rounded">
                    <div class="border-bottom py-4 px-5 mb-4">
                        <h4 class="text-primary mb-1">ベーシックプラン</h4>
                        <small class="text-uppercase">中小企業向け</small>
                    </div>
                    <div class="p-5 pt-0">
                        <h1 class="display-5 mb-3">
                            <small class="align-top" style="font-size: 22px; line-height: 45px;">¥</small>1000<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/ 月</small>
                        </h1>
                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">基本機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>打刻機能</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>日次勤怠管理</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>休暇管理機能</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>Kintai勤怠API</span><i class="fa fa-check text-primary pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">オプション機能：有給休暇管理/届出申請機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>届出申請ワークフロー</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>有給休暇等の自動付与</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>時間単位有給休暇</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>有給休暇管理レポート</span><i class="fa fa-times text-danger pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">オプション機能：シフト管理機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>シフト管理機能</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>勤務要請･変更依頼</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>サポート</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>メールサポート</span><i class="fa fa-times text-danger pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">制限機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>データ保存期間：制限なし</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>バナー広告：有</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>CSV出力：常時可能</span><i class="fa fa-times text-danger pt-1"></i></div>

                        <a href="" class="btn btn-primary py-2 px-4 mt-4">今すぐ注文</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <div class="bg-white rounded shadow position-relative" style="z-index: 1;">
                    <div class="border-bottom py-4 px-5 mb-4">
                        <h4 class="text-primary mb-1">スタンダードプラン</h4>
                        <small class="text-uppercase">中規模企業向け</small>
                    </div>
                    <div class="p-5 pt-0">
                        <h1 class="display-5 mb-3">
                            <small class="align-top" style="font-size: 22px; line-height: 45px;">¥</small>2500<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/ 月</small>
                        </h1>
                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">基本機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>打刻機能</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>日次勤怠管理</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>休暇管理機能</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>Kintai勤怠API</span><i class="fa fa-check text-primary pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">オプション機能：有給休暇管理/届出申請機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>届出申請ワークフロー</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>有給休暇等の自動付与</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>時間単位有給休暇</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>有給休暇管理レポート</span><i class="fa fa-check text-primary pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">オプション機能：シフト管理機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>シフト管理機能</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>勤務要請･変更依頼</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>サポート</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>メールサポート</span><i class="fa fa-times text-danger pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">制限機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>データ保存期間：制限なし</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>バナー広告：有</span><i class="fa fa-times text-danger pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>CSV出力：常時可能</span><i class="fa fa-times text-danger pt-1"></i></div>

                        <a href="" class="btn btn-primary py-2 px-4 mt-4">今すぐ注文</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="bg-light rounded">
                    <div class="border-bottom py-4 px-5 mb-4">
                        <h4 class="text-primary mb-1">アドバンスプラン</h4>
                        <small class="text-uppercase">大規模企業向け</small>
                    </div>
                    <div class="p-5 pt-0">
                        <h1 class="display-5 mb-3">
                            <small class="align-top" style="font-size: 22px; line-height: 45px;">¥</small>3500<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/ 月</small>
                        </h1>
                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">基本機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>打刻機能</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>日次勤怠管理</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>休暇管理機能</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>Kintai勤怠API</span><i class="fa fa-check text-primary pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">オプション機能：有給休暇管理/届出申請機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>届出申請ワークフロー</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>有給休暇等の自動付与</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>時間単位有給休暇</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>有給休暇管理レポート</span><i class="fa fa-check text-primary pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">オプション機能：シフト管理機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>シフト管理機能</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>勤務要請･変更依頼</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>サポート</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-5"><span>メールサポート</span><i class="fa fa-check text-primary pt-1"></i></div>

                        <div class="d-flex justify-content-between mb-3"><h5 class="text-primary">制限機能</h5></div>
                        <div class="d-flex justify-content-between mb-3"><span>データ保存期間：制限なし</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>バナー広告：有</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>CSV出力：常時可能</span><i class="fa fa-check text-primary pt-1"></i></div>
                        
                        <a href="" class="btn btn-primary py-2 px-4 mt-4">今すぐ注文</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pricing Plan End -->
<!-- Quote Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">見積もり依頼</h5>
                    <h1 class="mb-0">無料見積もりが必要ですか? お気軽にお問い合わせください。</h1>
                </div>
                <div class="row gx-3">
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                        <h5 class="mb-4"><i class="fa fa-reply text-primary me-3"></i>24時間以内に返信</h5>
                    </div>
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                        <h5 class="mb-4"><i class="fa fa-phone-alt text-primary me-3"></i>24時間電話サポート</h5>
                    </div>
                </div>
                {{-- <p class="mb-4">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p> --}}
                <div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">ご質問はお電話にて</h5>
                        <h4 class="text-primary mb-0">+080 4025 7029</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
                    <form>
                        <div class="row g-3">
                            <div class="col-xl-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="あなたの名前" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control bg-light border-0" placeholder="あなたのEmail" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-light border-0" rows="3" placeholder="メッセージ"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-dark w-100 py-3" type="submit">見積もり依頼</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quote End -->
@endsection