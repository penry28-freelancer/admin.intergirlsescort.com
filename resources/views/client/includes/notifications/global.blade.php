@if($global_notification = ListHelper::siteManagement('global_notification'))
<div class="global-notification" style="background: #3a6fc5">
    <div class="message-inner">
        <div class="message-content">{!! $global_notification !!}</div>
    </div>
</div>
@endif
