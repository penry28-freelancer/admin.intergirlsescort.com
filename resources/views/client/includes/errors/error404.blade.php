<div class="error">
    <div class="container-floud">
        <div class="col-xs-12 ground-color text-center">
            <div class="container-error-404">
                <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                <div class="msg">OH!<span class="triangle"></span></div>
            </div>
            <h2 class="h1">
                @if(!empty($message))
                <span>{{ $message }}</span>
                @else
                <span>Sorry! Page not found</span>
                @endif
            </h2>
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('client.home.index') }}" class="btn btn-primary my-auto shadow-none">Về lại trang chủ</a>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ get_file_version('/assets/css/includes/error404.min.css') }}">
<script src="{{ get_file_version('/assets/js/includes/error404.min.js') }}"></script>
