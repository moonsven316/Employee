@extends('top.layouts.app')
@section('content')
<!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
    @include('top.layouts.topmenu')
    @include('top.layouts.childcarousel')
</div>
<!-- Navbar & Carousel End -->
<!-- About Start -->
<div class="container-fluid py-2 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-3">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">人事管理システムマニュアル</h5>
                    <h3 class="mb-0">プロジェクト名：<br> HRソフト（人事管理システム）</h3>
                </div>
                <h5>基本機能</h5>
                <ul>
                    <li>企業の従業員管理</li>
                    <li>企業の従業員の勤怠管理</li>
                    <li>企業の従業員の打刻受付</li>
                </ul>
            
                <h5>利用者</h5>
                <ul>
                    <li>顧問先企業の人事</li>
                    <li>顧問先企業の従業員</li>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 500px;">
                <h5>システムの流れ</h5>
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide1.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid wow fadeInUp" data-wow-delay="0.15s">
    <div class="container py-3">
        <div class="row g-5">
            <div class="col-lg-6">
                <h5>管理者</h5>
                <ul>
                    <li>本サイトの管理者は会社情報管理業務を行っています。</li>
                </ul>
                <h5>①　会社新規登録</h5>
                <ul>
                    <li>「新規作成」タブをクリックすると会社情報を登録するページに飛びます。</li>
                    <li>このページで該当する項目を入力して、会社情報を登録できます。</li>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 313px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide2.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid wow fadeInUp" data-wow-delay="0.2s">
    <div class="container py-3">
        <div class="row g-5">
            <div class="col-lg-6">
                <h5>②　会社一覧</h5>
                <ul>
                    <li>「会社一覧」タブをクリックすると本システムに登録されているすべての会社情報を見ることができます。</li>
                    <li>青い枠に会社情報の概要をリストで表示します。</li>
                    <li>リストで会社名をクリックして、会社情報を閲覧できます。</li>
                    <li>赤枠には「印刷」「削除」「編集」ボタンがあります。</li>
                    <li>「編集」ボタンをクリックして、会社情報を編集することができます。</li>
                    <li>「削除」ボタンをクリックして、選択されている会社情報を削除できます。</li>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 313px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide3.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid wow pt-5 fadeInUp" data-wow-delay="0.25s">
    <div class="container py-3">
        <div class="row g-5">
            <div class="col-lg-6">
                <h5>会社法人</h5>
                <ul>
                    <li>会社法人は会社に関連しているすべての人事管理業務を行っています。</li>
                </ul>
                <h5>①　従業員管理</h5>
                <ul>
                    <li>従業員一覧</li>
                        <ol>会社に登録されているすべての従業員情報を一覧で見ることができます。</ol>
                    <li>新規追加</li>
                        <ol>従業員を登録できます。</ol>
                        <ol>基本情報、給与情報、所定日数設定項目タブがあります。</ol>
                        <ol>ー　基本情報タブでは</ol>
                            <ol>従業員のログイン情報（ICカードで打刻する時に利用する情報）と個人情報、従業員情報（雇用形態）を入力します。</ol>
                        <ol>ー　給与情報では</ol>
                            <ol>時給、基本給与、業務手当、役職手当、技術手当、出向調整金の既定項目を入力できます。</ol>
                            <ol>また、「アイテム追加」ボタンをクリックして補足項目も入力することができます。</ol>
                        <ol>ー所定日数設定では</ol>
                            <ol>1ヶ月あたりの所定労働日数を設定することができます。</ol>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 313px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide4.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6">
                <ul>
                    <li>部署一覧</li>
                        <ol>ー　部署一覧</ol>
                            <ol>会社にある部門、部署をリストで見ることができます。</ol>
                        <ol>ー　新規追加</ol>
                            <ol>部署を新規登録することができます。</ol>
                            <ol>親部門と子部門の情報を入力して保存、削除できます。</ol>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 313px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide5.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6">
                <ul>
                    <li>従業員管理項目一覧</li>
                        <ol>従業員を新規登録する時に従業員情報で表示する追加項目を作成します。</ol>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 170px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide6.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6">
                <ul>
                    <li>役職管理</li>
                        <ol>会社の役職を管理できます。</ol>
                        <ol>役職名の追加、編集、削除操作を行います。</ol>
                    <li>勤怠時間設定</li>
                        <ol>勤務時間を設定します。</ol>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 313px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide7.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid wow fadeInUp" data-wow-delay="0.3s">
    <div class="container py-3">
        <div class="row g-5">
            <div class="col-lg-6">
                <h5>②　勤怠管理</h5>
                <ul>
                    <li>勤怠一覧</li>
                        <ol>勤怠一覧タブでは従業員別の勤怠詳細とシフト設定操作を行います。</ol>
                        <ol>従業員の勤怠詳細情報を閲覧できます。</ol>
                        <ol>従業員は部門で絞り込むことができます。</ol>
                        <ol>シフト設定タブでは従業員の出勤、退勤、<br>休憩シフトを設定することができます。</ol>
                        <ol>そのシフト設定を基に従業員の勤怠状態を自動で判定します。</ol>
                        <ol>また、会社の管理者はその情報を手動で編集することも可能です。</ol>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 313px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide8.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6">
                <ul>
                    <li>シフト一覧</li>
                        <ol>登録されているシフト設定の一覧を表示されています。</ol>
                        <ol>シフト設定を新たに登録、編集、削除することが可能です。</ol>
                        <ol>登録されているシフト設定は適用済みと削除済みの両方で分けて表示されます。</ol>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 313px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide9.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid wow fadeInUp" data-wow-delay="0.35s">
    <div class="container py-3">
        <div class="row g-5">
            <div class="col-lg-6">
                <h5>③　変更情報詳細</h5>
                <ul>
                    <li>こちらでは部門の変更履歴を日付別で閲覧できます。</li>
                    <li>一般従業員</li>
                        <ol>一般従業員は会社法人のモバイルにICカードで打刻します。</ol>
                        <ol>一般従業員の打刻には出勤打刻、退勤打刻、休憩開始打刻、休憩終了打刻があります。</ol>
                </ul>
            </div>
            <div class="col-lg-6" style="min-height: 313px;">
                <div class="position-relative h-100">
                    <img style="object-fit: contain;" class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup-website-template/img/guide/guide10.png') }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
@endsection