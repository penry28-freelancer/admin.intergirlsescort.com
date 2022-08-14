<div class="footer-group-list">
    <h5 class="footer-group-list__header">Liên hệ</h5>
    <ul class="footer-group-list__items">
        @if($support_phone = ListHelper::siteManagement('support_phone'))
        <li>
            {!! svg_icon('phone') !!}
            <span>{{ $support_phone }}</span>
        </li>
        @endif
        @if($support_email = ListHelper::siteManagement('support_email'))
        <li>
            {!! svg_icon('email') !!}
            <span>{{ $support_email }}</span>
        </li>
        @endif
        @if($zalo_phone = ListHelper::siteManagement('zalo_phone'))
        <li>
            {!! svg_icon('zalo') !!}
            <span>zalo/{{ $zalo_phone }}</span>
        </li>
        @endif
    </ul>
</div>
