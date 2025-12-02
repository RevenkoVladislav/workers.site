<x-mail::message>
    Уважаемый,  {{ $userName }}, <br>
    Ваш персональный пароль: {{ $password }}
    <br>
    С уважением, <br>
    {{ config('app.name') }}
</x-mail::message>
