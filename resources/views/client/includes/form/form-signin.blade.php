<form method="POST" action="{{ route('client.auth.submit.signin') }}" class="form-wrapper" data-form="signin">
    @csrf
    <div class="form-group">
        <label for="email-signin">E-mail</label>
        <input
            type="text"
            class="form-control shadow-none @error('email') is-invalid @enderror"
            id="email-signin"
            name="email"
            placeholder="Nhập đia chỉ email"
            value="{{ old('email', '') }}"
        >
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password-signin">Mật khẩu</label>
        <input
            type="password"
            class="form-control shadow-none @error('password') is-invalid @enderror"
            id="password-signin"
            name="password"
            placeholder="Nhập mật khẩu"
        >
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        @error('credentials_incorrect')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember" value="on">Nhớ đăng nhập</label>
        </div>
        <a href="{{ route('client.auth.showForm.forgotPassword') }}">Quên mật khẩu?</a>
    </div>
    <button type="submit" class="btn btn-primary btn-block shadow-none btn-submit">Đăng nhập</button>
</form>
