@extends('top.layouts.app')
@section('content')
<!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
    @include('top.layouts.topmenu')
    @include('top.layouts.topcarousel')
</div>
<!-- Navbar & Carousel End -->
<!-- Facts Start -->
<div class="container-fluid facts py-5 pt-lg-0">
    <div class="container py-5 pt-lg-0">
        <div class="row gx-0">
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                    <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fa fa-users text-primary"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-white mb-0">支援体験</h5>
                        <h1 class="text-white mb-0" data-toggle="counter-up">1268</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fa fa-check text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-primary mb-0">現在使用中会社</h5>
                        <h1 class="mb-0" data-toggle="counter-up">600</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                    <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fa fa-award text-primary"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-white mb-0">スタッフ</h5>
                        <h1 class="text-white mb-0" data-toggle="counter-up">3968</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts Start -->
<!-- About Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">当社について</h5>
                    <h1 class="mb-0">人事実務の専門家集団と共同開発した、勤怠管理システム</h1>
                </div>
                <p class="mb-4">「Kintai勤怠」は、1000社以上のサポート経験により培った人事・労務の専門ノウハウが詰まった安価な勤怠管理システムです。</p>
                <p class="mb-4">人事実務の専門家がベンチャー企業で必要な機能を精査し、シンプルで使いやすい勤怠管理システムを共同開発しました。</p>
                <div class="row g-0 mb-3">
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>集計・確認作業の削減</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>リアルタイムでの勤怠確認</h5>
                    </div>
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>保管が容易</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>コスト削減</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">ご質問がありましたら、お電話ください。</h5>
                        <h4 class="text-primary mb-0">+080 4025 7029</h4>
                    </div>
                </div>
                {{-- <a href="quote.html" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Request A Quote</a> --}}
            </div>
            <div class="col-lg-5" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/about.jpeg') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
<!-- Features Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">なぜ私たちを選ぶのですか？</h5>
            <h1 class="mb-0">勤怠管理システム「Kintai勤怠」の特長</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="row g-5">
                    <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa fa-cubes text-white"></i>
                        </div>
                        <h4>低価格で今すぐ使える！</h4>
                        <p class="mb-0">シンプルで使いやすい勤怠管理システムを</p>
                    </div>
                    <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa fa-award text-white"></i>
                        </div>
                        <h4>人事実務の専門家集団と共同開発</h4>
                        <p class="mb-0">人事・労務の専門ノウハウが凝縮されており、労基法に準拠した労務管理を容易に行えます！</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s" src="{{ asset('assets/startup-website-template/img/feature.jpeg') }}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row g-5">
                    <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa fa-users-cog text-white"></i>
                        </div>
                        <h4>豊富な勤怠レポート</h4>
                        <p class="mb-0">日々の打刻履歴や月次の勤怠実績を可視化できます。</p>
                    </div>
                    <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <h4>24/10 サポート</h4>
                        <p class="mb-0">1日10時間以上サポートできます。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features Start -->
<!-- Service Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">勤怠管理システム「Kintai勤怠」の主要機能</h5>
            <h1 class="mb-0">ベンチャー企業で必要な機能を精査し、シンプルで使いやすいシステムになっています。</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-shield-alt text-white"></i>
                    </div>
                    <h4 class="mb-3">日次勤怠(タイムカード・打刻)</h4>
                    <p class="m-0">リアルタイムに従業員の勤怠を確認できます。毎日の打刻データと勤務データは別々に管理することが可能です。</p>
                    <a class="btn btn-lg btn-primary rounded" href="javascript:void(0);">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-chart-pie text-white"></i>
                    </div>
                    <h4 class="mb-3">CSVデータ出力</h4>
                    <p class="m-0">日次勤怠データや月次の集計データを従業員別に自由にCSV形式で出力することができます。</p>
                    <a class="btn btn-lg btn-primary rounded" href="javascript:void(0);">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-code text-white"></i>
                    </div>
                    <h4 class="mb-3">ICカード打刻</h4>
                    <p class="m-0">交通系ICカード(Suicaなど)や社員証などみなさんがご利用中のICカードをかざすだけで本人を識別しスムーズに打刻します。</p>
                    <a class="btn btn-lg btn-primary rounded" href="javascript:void(0);">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fab fa-android text-white"></i>
                    </div>
                    <h4 class="mb-3">休日・休暇管理</h4>
                    <p class="m-0">従業員別に年度・⽉ごとの「休⽇・休暇」の状況を確認できます。</p>
                    <a class="btn btn-lg btn-primary rounded" href="javascript:void(0);">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-search text-white"></i>
                    </div>
                    <h4 class="mb-3">残業アラート</h4>
                    <p class="m-0">社員の残業時間をリアルタイムで把握することが可能です。</p>
                    <a class="btn btn-lg btn-primary rounded" href="javascript:void(0);">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                    <h3 class="text-white mb-3">お見積りはお電話にて</h3>
                    <h2 class="text-white mb-0">+080 4025 7029</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->
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
<!-- Team Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">スタッフ</h5>
            <h1 class="mb-0">あなたのビジネスを助ける準備ができた専門家</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('assets/startup-website-template/img/team-1.png') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-twitter fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-instagram fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">赤木和雄</h4>
                        {{-- <p class="text-uppercase m-0">Designation</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('assets/startup-website-template/img/team-2.png') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-twitter fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-instagram fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">舞田 昌子</h4>
                        {{-- <p class="text-uppercase m-0">Designation</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('assets/startup-website-template/img/team-3.png') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-twitter fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-instagram fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">洞 公子</h4>
                        {{-- <p class="text-uppercase m-0">Designation</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->
@endsection