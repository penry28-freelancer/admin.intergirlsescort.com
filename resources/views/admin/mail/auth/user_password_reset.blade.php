@component('mail::message')
{{ trans('notifications.user_password_reset.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('notifications.user_password_reset.button_text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
@endcomponent
