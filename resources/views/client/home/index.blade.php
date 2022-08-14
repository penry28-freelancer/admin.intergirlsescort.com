@extends('client.layouts.master', [
    'title'       => 'Home',
    'description' => 'Description',
    'keywords'    => 'keywords',
    'body_id'     => 'pageHome'
])

@push('css')
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/views/home.min.css') }}" media="all">
@endpush

@section('wrapper_content')
    @include('client.includes.master-header')
    @include('client.includes.notifications.global')
    <main id="main-content">
        <section class="homepage-hero">
            <div class="position-absolute overflow-hidden" style="z-index: 0; top: 0; right: 0; bottom: 0; left: 0;">
                <img class="homepage-hero-bg" src="{{ get_storage_image_url(optional(ListHelper::siteManagement('bannerImage'))->path) }}" style="background: linear-gradient(0deg, rgba(243,244,248,1) 0%, rgba(255,255,255,0) 50%);">
            </div>
            <div class="wrapper">
                <div class="text-center py-5">
                    <h1 class="heading-type-one">{{ ListHelper::siteManagement('top_slogan') }}</h1>
                    <p class="body-type-one text-slate text-lg m-0">{{ ListHelper::siteManagement('sub_top_slogan') }}</p>
                </div>
                <div class="homepage-hero__container row">
                    <div class="homepage-hero__grid col-md-4">
                        <div class="row">
                            <div class="homepage-hero__tile col-md-6">
                                <a href="{{ route('client.public.plugins.show.CalculateGraduateScore') }}" class="homepage-hub-link bg-white box-shadow-two">
                                    {!! svg_icon('calculate', 30, 30) !!}
                                    <span class="heading">Tính điểm TN</span>
                                </a>
                            </div>
                            <div class="homepage-hero__tile col-md-6">
                                <a href="" class="homepage-hub-link bg-white box-shadow-two">
                                    <span class="icon">ICON</span>
                                    <span class="heading">Lorem, ipsum dolor.</span>
                                </a>
                            </div>
                            <div class="homepage-hero__tile col-md-6">
                                <a href="" class="homepage-hub-link bg-white box-shadow-two">
                                    <span class="icon">ICON</span>
                                    <span class="heading">Lorem, ipsum dolor.</span>
                                </a>
                            </div>
                            <div class="homepage-hero__tile col-md-6">
                                <a href="" class="homepage-hub-link bg-white box-shadow-two">
                                    <span class="icon">ICON</span>
                                    <span class="heading">Lorem, ipsum dolor.</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="homepage-hero__main col-md-8">
                        <div class="homepage-signup bg-white box-shadow-two">
                            <div class="homepage-signup__head">
                                <h6>NEW: FREE FINANCIAL COACHING</h6>
                            </div>
                            <div class="homepage-signup__body">
                                <div class="text-wrapper">
                                    <h4 class="type-heading">Level up your finances</h4>
                                    <p class="text-slate">Get 1-on-1 guidance from a certified financial coach. No commitment, no prep work, no fees.</p>
                                </div>
                                @if(!\StudentFacades::isLogin())
                                <div class="button-grid">
                                    <a href="{{ route('client.auth.showForm.signin', ['tab' => 'signin']) }}" class="button-grid__item button-signin">Đăng nhập</a>
                                    <a href="{{ route('client.auth.showForm.signin', ['tab' => 'signup']) }}" class="button-grid__item button-signup">Tạo tài khoản mới?</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
