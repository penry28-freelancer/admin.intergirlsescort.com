<form method="POST" action="{{ route('client.settings.profile.me.updatePassword') }}" class="form-wrapper" data-form="profile-setting-password">
    @csrf
    <div class="form-group">
        <label for="password_old">Nhập mật khẩu cũ</label>
        <input
            type="password"
            class="form-control shadow-none @error('password_old') is-invalid @enderror"
            id="password_old"
            name="password_old"
            placeholder="Nhập mật khẩu cũ"
        >
        @error('password_old')
            <span class="invalid-feedback server" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Nhập mật khẩu mới</label>
        <input
            type="password"
            class="form-control shadow-none @error('password') is-invalid @enderror"
            id="password"
            name="password"
            placeholder="Nhập mật khẩu mới"
        >
        @error('password')
            <span class="invalid-feedback server" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Nhập lại mật khẩu mới</label>
        <input
            type="password"
            class="form-control shadow-none @error('password_confirmation') is-invalid @enderror"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Nhập mật khẩu mới"
        >
        @error('password_confirmation')
            <span class="invalid-feedback server" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</form>
