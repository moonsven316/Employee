@extends("layouts.auth")

@section("content")
<div class="login_wrapper">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="title text-center">パスワードを変更する</h3>
		</div>
	</div>
	<div class="row center">
		<div class="login-form col-sm-12">          
			<form method="POST" action="{{ route('password.update') }}">
				@csrf

				<input type="hidden" name="user_id" value="{{ $user_id }}">

				{{-- <div class="form-group">
					<label for="email">メルアドレス</label>
					<input type="email" class="form-control" name="email" placeholder="abc@gmail.com" required autofocus />
				</div> --}}

				<div class="form-group">
					<label for="password">パスワード</label>
					<input type="password" class="form-control" name="password"  placeholder="********" required autocomplete="password" />
				</div>

				<div class="form-group">
					<label for="password_confirmation">パスワード確認</label>
					<input type="password" class="form-control" name="password_confirmation"  placeholder="********" required autocomplete="new-password" />
				</div>

				<div class="flex items-center justify-end mt-4">
					<button class="btn btn-primary float-right">
					パスワードをリセット
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection