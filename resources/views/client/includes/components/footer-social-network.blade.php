<div class="footer-group-list">
    <h5 class="footer-group-list__header">Mạng xã hội</h5>
    <p class="footer-group-list__desc">Theo dõi các mạng xã hội để có được những thông tin mới nhất nhé</p>
    <ul class="footer-group-list__items d-flex">
        @if($facebook_link = ListHelper::siteManagement('facebook_link'))
        <li class="mr-2">
            <a href="{{ $facebook_link }}" target="_blank">
                {!! svg_icon('facebook-fill', 37, 37) !!}
            </a>
        </li>
        @endif
        @if($instagram_link = ListHelper::siteManagement('instagram_link'))
        <li class="mr-2">
            <a href="{{ $instagram_link }}" target="_blank">
                {!! svg_icon('twitter-fill', 40, 40) !!}
            </a>
        </li>
        @endif
        @if($youtube_link = ListHelper::siteManagement('youtube_link'))
        <li>
            <a href="{{ $youtube_link }}" target="_blank">
                {!! svg_icon('youtube-fill', 40, 40) !!}
            </a>
        </li>
        @endif
    </ul>
</div>
