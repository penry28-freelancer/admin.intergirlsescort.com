<form method="POST" action="{{ route('client.settings.profile.me.update') }}" class="form-wrapper" data-form="profile-setting-account">
    @csrf
    <div class="form-group">
        <label for="name">Tên của bạn</label>
        <input
            type="text"
            class="form-control shadow-none @error('name') is-invalid @enderror"
            id="name"
            name="name"
            placeholder="Nhập tên của bạn"
            value="{{ old('name', $profile->name) }}"
        >
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Username</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">{{ url('/profile') }}/</span>
            </div>
            <input
                type="text"
                class="form-control shadow-none @error('username') is-invalid @enderror"
                id="username"
                name="username"
                placeholder="Nhập username của bạn"
                value="{{ old('username', $profile->username) }}"
            >
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input
            type="text"
            class="form-control shadow-none @error('email') is-invalid @enderror"
            id="email"
            name="email"
            placeholder="Nhập đia chỉ email"
            value="{{ old('email', $profile->email) }}"
        >
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <input
            type="text"
            class="form-control shadow-none @error('email') is-invalid @enderror"
            id="phone"
            name="phone"
            placeholder="Nhập số điện thoại"
            value="{{ old('phone', $profile->phone) }}"
        >
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <x-input-select-group-birthday :dayValue="old('dob', $profile->dob)" :monthValue="old('mob', $profile->mob)" :yearValue="old('yob', $profile->yob)" :errors="$errors" />
    <div class="form-group">
        <label for="sex">Giới tính</label>
        <select
            id="sex"
            name="sex"
            class="form-control shadow-none"
            value="{{ old('sex', $profile->sex) }}"
        >
            <option value="1">Nam</option>
            <option value="2">Nữ</option>
            <option value="3">LGBT</option>
          </select>
    </div>
</form>
