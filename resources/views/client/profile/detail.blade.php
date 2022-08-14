@extends('client.layouts.master', [
    'title'       => 'Profile',
    'description' => 'Description',
    'keywords'    => 'keywords',
    'body_id'     => 'pageProfile'
])

@push('css')
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/views/profile.min.css') }}" media="all">
@endpush

@section('wrapper_content')
    @include('client.includes.master-header')
    @include('client.includes.notifications.global')
    <main id="main-content">
        <div class="profile-preview">
            <div class="container profile-preview__wrapper">
                @if (! empty($student))
                @include('client.includes.modal-update-avatar')
                <div class="row">
                    <div class="col-md-8">
                        <div class="profile-preview__inner">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="profile-preview__avt">
                                        <div class="avt-thumnail">
                                            <img src="{{ avatar_cute_path($student->avatar) }}" alt="" class="avt-target">
                                            <span class="edit" data-toggle="modal" data-target="#updateAvatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="profile-preview__info">
                                        <h1 class="profile-preview__username">
                                            <span class="username">{{ ucfirst($student->name) }}</span>
                                            <div class="user-id">{{ $student->username }}</div>
                                        </h1>
                                        <div class="profile-preview__joined-date">
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                </svg>
                                            </span>
                                            <span>Đã tham gia {{ format_date($student->created_at, 'd/m/Y') }}</span>
                                        </div>
                                        <div class="profile-preview__follower">
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                                </svg>
                                            </span>
                                            <span>Đang theo dõi 0 / 0 Người theo dõi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (\StudentFacades::studentInfo('id') == $student->id)
                    <div class="col-md-4 d-flex justify-content-end align-items-start">
                        <a href="{{ route('client.settings.profile.me.setting') }}" class="btn btn-primary shadow-none profile-preview__edit-btn">
                            <span class="edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </span>
                            <span>Sửa hồ sơ</span>
                        </a>
                    </div>
                    @endif
                </div>
                @else
                @include('client.includes.errors.error404', ['message' => 'Oh! Sinh viên này không tồn tại rồi bạn ơi'])
                @endif
            </div>
        </div>
        <div class="profile-statistical"></div>
    </main>
@endsection
@push('js')
<script src="{{ get_file_version('/assets/js/views/settings-profile.min.js') }}"></script>
@endpush

