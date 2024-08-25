<style>
.bg-header {
    background: linear-gradient(rgba(9, 30, 62, .7), rgba(9, 30, 62, .7)), url("{{ asset('assets/startup-website-template/img/carousel-1.jpeg') }}") center center no-repeat;
    background-size: cover;
}
</style>
<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
    <div class="row py-5">
        <div class="col-12 pt-lg-5 mt-lg-5 text-center">
            <h1 class="display-4 text-white animated zoomIn">
                @php
                    if(strpos(url()->current(), "plan")) {
                        echo '料金';
                    } elseif(strpos(url()->current(), "contact")) {
                        echo 'コンタクト';
                    } elseif(strpos(url()->current(), "guide")) {
                        echo 'ガイド';
                    }
                @endphp
            </h1>
            <a href="{{ route('top') }}" class="h5 text-white">TOP</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h5 text-white">
                @php
                    if(strpos(url()->current(), "plan")) {
                        echo '料金';
                    } elseif(strpos(url()->current(), "contact")) {
                        echo 'コンタクト';
                    } elseif(strpos(url()->current(), "guide")) {
                        echo 'ガイド';
                    }
                @endphp
            </a>
        </div>
    </div>
</div>