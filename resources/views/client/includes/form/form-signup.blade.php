<form method="POST" action="{{ route('client.auth.submit.signup') }}" data-form="signup" class="form-wrapper">
    @csrf
    <div class="form-group">
        <label for="name-signup">Tên của bạn</label>
        <input
            type="text"
            class="form-control shadow-none @error('name') is-invalid @enderror"
            id="name-signup"
            name="name"
            placeholder="Nhập tên của bạn"
            value="{{ old('name', '') }}"
        >
        @error('name')
            <span class="invalid-feedback server" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email-signup">E-mail</label>
        <input
            type="text"
            class="form-control shadow-none @error('email') is-invalid @enderror"
            id="email-signup"
            name="email"
            placeholder="Nhập đia chỉ email"
            value="{{ old('email', '') }}"
        >
        @error('email')
            <span class="invalid-feedback server" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="sex-signup">Giới tính</label>
        <select
            id="sex-signup"
            class="form-control shadow-none @error('sex') is-invalid @enderror"
            name="sex"

        >
            <option value="1" selected>Nam</option>
            <option value="2">Nữ</option>
            <option value="3">LGBT</option>
        </select>
        @error('sex')
            <span class="invalid-feedback server" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password-signup">Mật khẩu</label>
        <input
            type="password"
            class="form-control shadow-none @error('password') is-invalid @enderror"
            id="password-signup"
            name="password"
            placeholder="Nhập mật khẩu"
        >
        @error('password')
            <span class="invalid-feedback server" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation-signup">Nhập lại mật khẩu</label>
        <input type="password" class="form-control shadow-none" id="password_confirmation-signup" name="password_confirmation" placeholder="Nhập lại mật khẩu">
    </div>
    <button type="submit" class="btn btn-primary btn-block shadow-none btn-submit">Đăng ký</button>
</form>
