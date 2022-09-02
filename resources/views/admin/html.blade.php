@php
$config = [
    'appName' => config('app.name'),
    'locale'  => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'constants' => [
        'sex' => config('constants.sex'),
        'faq_type' => config('constants.faq_type')
    ]
];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ \App::getLocale() }}"/>
    <title>{{ config('app.name', 'CBA Laravel Vue') }}</title>
    <!-- Stylesheet -->
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet">
</head>
<body data-app="{{ json_encode($config) }}">

<noscript>
    <strong>We're sorry but CBA, HTML & Laravel Admin Dashboard Template doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript>

<div id="app"></div>

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js')}}"></script>
<script src="{{ mix('js/app.js')}}"></script>
</body>
</html>
