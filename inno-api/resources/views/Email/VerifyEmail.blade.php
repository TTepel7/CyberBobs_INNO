@component('mail::message')
# Подтверждение почты

Нажмите на кнопку, чтобы подтвердить почту

@component('mail::button', ['url' => "http://innoapi.cyberbobs.xsph.ru/api/verify_password/?token=".$info['token']])
Подтвердить
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
