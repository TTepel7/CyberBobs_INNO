@component('mail::message')
# Подтверждение почты

Нажмите на кнопку, чтобы подтвердить почту

@component('mail::button', ['url' => route('verify',['token'=>$info['token']])])
Подтвердить
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
