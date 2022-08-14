<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ ListHelper::siteManagement('meta_description') }}">
    <meta name="keywords" content="{{ ListHelper::siteManagement('meta_keywords') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta property="fb:app_id" content="">
    <meta property="og:title" content="{{ ListHelper::siteManagement('meta_title') }}">
    <meta property="og:type" content="{{ ListHelper::siteManagement('meta_type') }}">
    <meta property="og:description" content="{{ ListHelper::siteManagement('meta_description') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="">
    <meta property="og:site_name" content="{{ url('/') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="intergirlsescort.com">
    <meta name="twitter:title" content="{{ ListHelper::siteManagement('meta_title') }}">
    <meta name="twitter:description" content="{{ ListHelper::siteManagement('meta_description') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (request()->getHttpHost() !== 'intergirlsescort.com')
    <meta name="robots" content="noindex, nofollow">
    @endif
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ get_storage_image_url(optional(ListHelper::siteManagement('faviconImage'))->path) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ get_storage_image_url(optional(ListHelper::siteManagement('faviconImage'))->path) }}">
    <link rel="manifest" href="/assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/assets/img/favicon/safari-pinned-tab.svg" color="#0e3092">
    <link rel="shortcut icon" href="/assets/img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="/assets/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <title>{{ @$title }}</title>
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/index.min.css') }}" media="all">
    <!-- Bootstap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    @stack('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/plugins/CSSPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/easing/EasePack.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenLite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TimelineLite.min.js"></script>
    <!-- Plugins JS -->
    <script src="{{ get_file_version('/assets/plugins/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ get_file_version('/assets/plugins/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    @if (request()->getHttpHost() == 'intergirlsescort.com' && Route::current() !== null && Route::current()->getName() == 'client.index')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "url": "{{ route('client.home.index') }}",
                "logo": "{{ secure_asset('assets/img/svg/logo_icon.svg') }}"
            }
        </script>
    @endif
</head>

<body class="{{ @$body_class }}" id="{{ @$body_id }}">
    <div id="wrapper">
        @yield('wrapper_content')
        @include('client.includes.master-footer')
    </div>
    <script src="{{ get_file_version('/assets/js/bundle.min.js') }}"></script>
    @stack('js')
</body>
</html>
