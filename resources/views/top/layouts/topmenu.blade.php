<nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
    <a href="{{ route('top') }}" class="navbar-brand p-0">
        <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>Kintai</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('top') }}" <?php if(strpos(url()->current(), "top")) echo 'class="nav-item nav-link active"'; else echo 'class="nav-item nav-link"';?>>TOP</a>
            <a href="{{ route('plan') }}" <?php if(strpos(url()->current(), "plan")) echo 'class="nav-item nav-link active"'; else echo 'class="nav-item nav-link"';?>>料金</a>
            <a href="{{ route('contact') }}" <?php if(strpos(url()->current(), "contact")) echo 'class="nav-item nav-link active"'; else echo 'class="nav-item nav-link"';?>>コンタクト</a>
            <a href="{{ route('guide') }}" <?php if(strpos(url()->current(), "guide")) echo 'class="nav-item nav-link active"'; else echo 'class="nav-item nav-link"';?>>ガイド</a>
        </div>
        {{-- <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton> --}}
        <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4 ms-3">ログイン</a>
    </div>
</nav>