@extends('top.layouts.app')
@section('content')
<!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
    @include('top.layouts.topmenu')
    @include('top.layouts.childcarousel')
</div>
<!-- Navbar & Carousel End -->
<!-- Contact Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">お問い合わせ</h5>
            <h1 class="mb-0">ご質問がございましたら、お気軽にお問い合わせください</h1>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">ご質問はお電話にて</h5>
                        <h4 class="text-primary mb-0">+080 4025 7029</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">メールで無料見積もりを取得する</h5>
                        <h4 class="text-primary mb-0">shoutuoshisutemu@gmail.com</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">オフィスを訪問する</h5>
                        <h4 class="text-primary mb-0">大阪府大阪市旭区新森3丁目2-22フォレストヴィラ403</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control border-0 bg-light px-4" placeholder="名前" style="height: 55px;">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control border-0 bg-light px-4" placeholder="Email" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control border-0 bg-light px-4" placeholder="主題" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control border-0 bg-light px-4 py-3" rows="4" placeholder="メッセージ"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">メッセージ送信</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                <iframe class="position-relative rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.220028258391!2d135.564993415261!3d34.75704578042357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e9d3d3f8b5b7%3A0x4c7e4c1f3e8d6a2!2z44CSMTAwLTAwMjMg5p2x5L2P5Yy65YyX5LiK5Yy65YyX!5e0!3m2!1sen!2sbd!4v1680000000000!5m2!1sen!2sbd"
                frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>

            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection