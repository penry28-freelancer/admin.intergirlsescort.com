<footer class="footer">
    <div class="footer-inner">
        <div class="container-fluid px-5">
            <div class="row">
                <section class="col-md-12 footer-section section-1">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="footer-slogan-title">Never stop learning because life never stop teaching.</h4>
                            <p class="footer-slogan-desc">Đừng bao giờ ngừng học tập vì cuộc đời không bao giờ ngừng dạy.</p>
                            <small class="footer-slogan-author">(Sưu tầm)</small>
                        </div>
                        @if($brand_name = ListHelper::siteManagement('brand_name'))
                        <div class="col-md-6">
                            <h2 class="footer-top-logo text-right">
                                <a href="{{ route('client.home.index') }}">{{ $brand_name }}</a>
                            </h2>
                        </div>
                        @endif
                    </div>
                </section>
                <section class="col-md-12 footer-section section-2">
                    <div class="row">
                        <div class="col-md-4">
                            @include('client.includes.components.footer-contact')
                        </div>
                        <div class="col-md-4">
                            @include('client.includes.components.footer-fb-fanpage')
                        </div>
                        <div class="col-md-4">
                            @include('client.includes.components.footer-social-network')
                        </div>
                    </div>
                </section>
                <section class="col-md-12 footer-section section-3">
                    @include('client.includes.components.footer-posts')
                </section>
            </div>
        </div>
    </div>
</footer>
