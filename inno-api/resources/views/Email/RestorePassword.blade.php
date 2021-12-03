@component('mail::message')
# Сброс пароля

Ваш новый пароль

Email: {{$info['email']}}
Пароль: {{$info['pass']}}

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
