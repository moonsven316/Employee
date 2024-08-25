@extends("layouts.auth")

@section("content")
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <form id="demo-form" data-parsley-validate="" novalidate="" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-md-12 col-sm-12 col-12 mb-5">
                    <div class="product-image">
                        <img src="{{ asset('assets/img/login_banner.png') }}" alt="..."  style="width: 100%;">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-12 mb-3">
                    <label for="fullname">ユーザーID</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder=" " required/>
                    @error('email')
                    <small class="text-danger text-xs">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 col-sm-12 col-12 mb-5">
                    <label for="email">パスワード</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder=" " required/>
                </div>
                <div class="col-md-12 col-sm-12 col-12 mb-3">
                    <div class="row">
                        <div class="col-sm-4 col-4"></div>
                        <div class="col-sm-4 col-4">
                            <button class="btn btn-primary rounded-md" type="submit">ログイン</button>
                        </div>
                        <div class="col-sm-4 col-4"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="d-flex">
                        <a class="reset_pass" href="{{ route('forgot') }}">パスワードをお忘れですか？</a>
                        <a class="reset_pass mx-4" href="{{ route('top') }}">TOPページ</a>
                    </div>
                </div>
            </form>
        </div>
        <div id="register" class="animate form registration_form">
            <section class="login_content">
              <form>
                <div class="col-md-12 col-sm-12 col-12 mb-5">
                    <div class="product-image">
                        <img src="{{ asset('assets/img/login_banner.png') }}" alt="..."  style="width: 100%;">
                    </div>
                </div>
                <h1>打刻受付</h1>
                <div class="col-md-12 col-m-12 col-12 mb-5">
                    <span class="clock" style="font-size:2.5rem;"></span>
                </div>
                <div class="col-md-12 mb-4 col-12">
                    <div class="col-sm-4 col-4" style="font-size:20px;">
                        <input type="radio" class="flat text-start" name="attend_1" id="genderM" value="M" checked="" required />:出 勤
                    </div>
                    <div class="col-sm-3 col-3"></div>
                    <div class="col-sm-4 col-4" style="font-size:22px;">
                        <input type="radio" class="flat" name="attend_1" id="genderM" value="M" required />:退 勤
                    </div>
                </div>
                <div class="col-md-12 mb-3 col-12">
                    <div class="col-sm-5 col-5" style="font-size:22px;">
                        <input type="radio" class="flat" name="attend_1" id="genderM" value="M" required />:休憩開始
                    </div>
                    <div class="col-sm-2 col-2"></div>
                    <div class="col-sm-5 col-5" style="font-size:22px;">
                        <input type="radio" class="flat" name="attend_1" id="genderM" value="M" required />:休憩終了
                    </div>
                </div>
                <div class="row mb-3">
                    <textarea name="status" id="status" cols="30" rows="10" class="form-control">Web NFC is not available. Use Chrome on Android.</textarea>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-sm-4 col-4"></div>
                    <div class="col-md-4 col-sm-4 col-4">
                        <a href="#signin" class="btn-lg btn-primary rounded-lg w-100" id="">戻る</a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-4"></div>
                </div>
              </form>
            </section>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var status = "";
    scanButton.addEventListener("click", async () => {
        console.log("User clicked scan button");
        // $("#status").val('User clicked scan button');
        status += 'User clicked scan button';
        try {
            const ndef = new NDEFReader();
            await ndef.scan();
            // $("#status").val('> Scan started');
            status += '> Scan started';
            ndef.addEventListener("readingerror", () => {
                // $("#status").val('Argh! Cannot read data from the NFC tag. Try another one?');
                status += 'Argh! Cannot read data from the NFC tag. Try another one?';

            });

            ndef.addEventListener("reading", ({ message, serialNumber }) => {
                // $("#status").val(`> Serial Number: ${serialNumber}`);
                // $("#status").val(`> Records: (${message.records.length})`);
                status += `> Serial Number: ${serialNumber}`;
                status += `> Records: (${message.records.length})`;
            });
        } catch (error) {
            // $("#status").val("Argh! " + error);
            status += "Argh! " + error;
        }
        $("#status").val(status);
    });
    writeButton.addEventListener("click", async () => {
        // $("#status").val('User clicked write button');
        status += 'User clicked write button';
        try {
            const ndef = new NDEFReader();
            await ndef.write("Hello world!");
            // $("#status").val('> Message written');
            status += '> Message written';
        } catch (error) {
            // $("#status").val("Argh! " + error);
            status += "Argh! " + error;
        }
        $("#status").val(status);
    });
    makeReadOnlyButton.addEventListener("click", async () => {
        // log("User clicked make read-only button");
        status += "User clicked make read-only button";

        try {
            const ndef = new NDEFReader();
            await ndef.makeReadOnly();
            // log("> NFC tag has been made permanently read-only");
            status += "> NFC tag has been made permanently read-only";
        } catch (error) {
            // log("Argh! " + error);
            status += "Argh! " + error;
        }
        $("#status").val(status);
    });
</script>
@endsection
