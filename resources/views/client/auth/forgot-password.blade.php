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
            'Quên mật khẩu' => ''
        ],
        'title' => 'Quên mật khẩu'
    ])
    <main id="main-content">
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="auth-form">
                            <div class="heading">
                                <div class="title">Đừng lo lắng</div>
                                <div class="desc">Hãy nhập địa chỉ email mà trước đây bạn đã dùng để đăng ký tài khoản của bạn, chúng tôi sẽ gửi cho bạn một email chứa mã xác nhận</div>
                            </div>
                            <div class="tabs-container">
                                @if(session('send_mail_reset_pass_success'))
                                @php
                                    $data = \Session::get('send_mail_reset_pass_success');
                                @endphp
                                <div class="alert alert-success" role="alert">
                                    {{ $data['message'] }}
                                </div>
                                <div>
                                    <a href="{{ route('client.home.index') }}" class="btn btn-primary btn-sm mr-2">Về trang chủ</button>
                                    <a href="mailto:{{ $data['email'] }}" class="btn btn-outline-primary btn-sm">Đến e-mail của bạn</a>
                                    <a href="{{ route('client.auth.showForm.forgotPassword') }}" class="btn btn-outline-primary btn-sm">Gửi lại</a>
                                </div>
                                @else
                                <form method="POST" action="{{ route('client.auth.submit.forgotPassword') }}" data-form="forgot-password" class="form-wrapper">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">E-mail xác nhận</label>
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
                                    <button type="submit" class="btn btn-primary btn-block shadow-none btn-submit">Gửi mã xác nhận</button>
                                    <a href="{{ route('client.auth.showForm.signin') }}" class="mt-3 d-inline-block">Quay về đăng nhập</a>
                                </form>
                                @endif
                            </div>
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

