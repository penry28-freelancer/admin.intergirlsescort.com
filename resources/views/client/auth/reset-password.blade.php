@extends('client.layouts.master', [
    'title'       => 'Signin',
    'description' => 'Description',
    'keywords'    => 'keywords',
    'body_id'     => 'pageSignin'
])

@push('css')
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/views/auth.min.css') }}" media="all">
@endpush

@section('wrapper_content')
    @include('client.includes.master-header')
    @include('client.includes.notifications.global')
    @include('client.includes.breadcrumb-app', [
        'items' => [
            'Thay đổi mật khẩu' => ''
        ],
        'title' => 'Thay đổi mật khẩu'
    ])
    <main id="main-content">
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="auth-form">
                            @if(session('reset_pass_success'))
                            <div class="alert alert-success" role="alert">
                                <span>Khôi phục mật khẩu thành công</span>
                            </div>
                            <div>
                                <a href="{{ route('client.home.index') }}" class="btn btn-primary btn-sm mr-2">Về trang chủ</button>
                                <a href="{{ route('client.auth.showForm.signin') }}" class="btn btn-outline-primary btn-sm">Đăng nhập</a>
                            </div>
                            @else
                            <div class="heading">
                                <div class="title">Nhập mật khẩu mới</div>
                                <div class="desc">Hãy nhập một mật khẩu mà bạn tin là khó có ai đoán được nhé!</div>
                            </div>
                            <div class="tabs-container">
                                <form method="POST" action="{{ route('client.auth.submit.resetPassword') }}" data-form="reset-password" class="form-wrapper">
                                    @csrf
                                    <input type="hidden" name="_token_reset_pass" value="{{ $token }}">
                                    <div class="form-group">
                                        <label for="password">Mật khẩu</label>
                                        <input
                                            type="password"
                                            class="form-control shadow-none @error('password') is-invalid @enderror"
                                            id="password"
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
                                        <label for="password_confirmation">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control shadow-none" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block shadow-none btn-submit">Cập nhật mật khẩu mới</button>
                                    <a href="{{ route('client.auth.showForm.signin') }}" class="mt-3 d-inline-block">Quay về đăng nhập</a>
                                    <span>|</span>
                                    <a href="{{ route('client.auth.showForm.signin', ['tab' => 'signup']) }}" class="mt-3 d-inline-block">Tạo tài khoản mới</a>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('js')
<script src="{{ get_file_version('/assets/js/views/auth.min.js') }}"></script>
@endpush
