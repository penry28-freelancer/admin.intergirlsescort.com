<div class="breadcrumb-app">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('client.home.index') }}">Trang chủ</a></li>
                        @if(!empty($items))
                        @php $i=1; @endphp
                        @foreach ($items as $name => $link)
                        @if($i === count($items))
                        <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
                        @else
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ $link }}">{{ $name }}</a>
                        </li>
                        @endif
                        @php $i++ @endphp
                        @endforeach
                        @endif
                    </ol>
                </nav>
                <div class="page-title">{{ $title }}</div>
            </div>
        </div>
    </div>
</div>
