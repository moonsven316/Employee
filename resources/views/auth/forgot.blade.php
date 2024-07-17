@extends("layouts.auth")

@section("content")
<div class="login_wrapper">
	<h4 class="mb-2">パスワードを忘れましたか? 🔒</h4>
	<form id="formAuthentication" class="mb-3" method="GET" action="{{ route('reset') }}" onsubmit="validate(event)">
		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" class="form-control" placeholder="Email" name="email" id="email" autofocus />
		</div>
		<div class="alert alert-primary" role="alert">ご登録さわたメールアドレスにパスワード再設定のご案内が送信されます。</div>
		<button type="submit" value="送信する" class="btn btn-primary d-grid w-100">送信する</button>
	</form>
	<div class="text-center">
		<a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
			<i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
			ログイン
		</a>
	</div>
</div>

<div id="toast-container" class="toast-top-right"></div>
@endsection
<script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
<script>
	let emails = <?php echo $emails; ?>;
	const validate = function(e) {
		let addr = document.getElementById('email').value;
		let addrs = [];
		for (const addr of emails) {
			addrs.push(addr.email);
		}

		console.log(addrs);

		if (addrs.indexOf(addr) == -1) {
			e.preventDefault();
			toastr.error('登録されたメールではありません。');
			setTimeout(() => {
				location.href = "/";
			}, 5000);
			return false;
		} else {
			toastr.success('情報が正常に送信されました。');
			setTimeout(() => {
				location.href = "/";
			}, 5000);
			return true;
		}
	};
</script>