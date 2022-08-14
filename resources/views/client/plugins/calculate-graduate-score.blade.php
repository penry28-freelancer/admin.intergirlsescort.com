@extends('client.layouts.master', [
    'title'       => 'Home',
    'description' => 'Description',
    'keywords'    => 'keywords',
    'body_id'     => 'pageHome'
])

@push('css')
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/views/calculate-graduate-score.min.css') }}" media="all">
@endpush

@section('wrapper_content')
    @include('client.includes.master-header')
    @include('client.includes.notifications.global')
    @include('client.includes.breadcrumb-app', [
        'items' => [
            'Plugins' => 'https://plugin.com',
            'Calculate Graduate Score' => ''
        ],
        'title' => 'Tính điểm tốt nghiệp'
    ])
    <main id="main-content">
        <div class="plugins">
            <div class="container plugins__wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="plugins-tabs">
                            <li>
                                <a href="{{ route('client.public.plugins.show.CalculateGraduateScore', ['tab' => 'overview']) }}" class="plugins-tabs__link {{ href_tab_active(['overview', 'tool', 'result'], 0, true) }}">Tổng quát</a>
                            </li>
                            <li>
                                <a href="{{ route('client.public.plugins.show.CalculateGraduateScore', ['tab' => 'tool']) }}" class="plugins-tabs__link {{ href_tab_active(['overview', 'tool', 'result'], 1, false) }}">Công cụ tính điểm tốt nghiệp</a>
                            </li>
                        </ul>
                    </div>
                    @switch(\Request::get('tab'))
                        @case('overview')
                        @case('')
                        <div class="col-md-12">
                            <div class="plugins-overview">
                                <h3 class="plugins-overview__header">Tính điểm tốt nghiệp</h3>
                                <div class="plugins-overview__content">
                                    <p>Điểm của từng bài thi được quy về thang điểm 10 để tính điểm xét tốt nghiệp. Điểm xét tốt nghiệp sẽ bao gồm: 70% điểm thi THPT và 30% điểm trung bình lớp 12. Điểm xét tốt nghiệp sẽ được lấy đến 2 chữ số thập phân, do phần mềm máy tính tự động thực hiện.</p>
                                    <img src="https://media.vov.vn/sites/default/files/styles/large/public/2021-07/diem-xet-tot-nghiep-2020-23071740.png" alt="">
                                </div>
                            </div>
                        </div>
                        @break
                        @case('tool')
                        <div class="col-md-12 position-relative">
                            <div class="plugins-handler">
                                <h3 class="plugins-handler__header">Công cụ hỗ trợ tính điểm tốt nghiệp</h3>
                                <div class="plugins-handler__content">
                                    <ul class="nav nav-tabs" id="myTab" role="tabCalculateGraduateScore">
                                        <li class="nav-item">
                                            <a data-href-tab="he-gd-thpt" class="nav-link {{ href_tab_active(['he-gd-thpt', 'he-gdtx'], 0, true) }}" id="he-gd-thpt-tab" data-toggle="tab" href="#he-gd-thpt" role="tab" aria-controls="he-gd-thpt" aria-selected="true">Hệ GD THPT</a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-href-tab="he-gdtx" class="nav-link {{ href_tab_active(['he-gd-thpt', 'he-gdtx'], 1, false) }}" id="he-gdtx-tab" data-toggle="tab" href="#he-gdtx" role="tab" aria-controls="he-gdtx" aria-selected="false">Hệ GDTX</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @include('client.includes.form.form-calculate-graduate-score', ['prefix' => 'diem'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break
                        @case('result')
                        <div class="plugins-handler__result">

                        </div>
                        @break
                        @default
                        <script>window.location = "{{ route('client.public.plugins.show.CalculateGraduateScore') }}";</script>
                    @endswitch
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
<script src="{{ get_file_version('/assets/js/views/calculate-graduate-score.min.js') }}"></script>
@endpush
