<x-mail::message>
# Credenciais

Olá {{$user->name}} Acesse o sistema e altere sua senha .

<x-mail::button :url="$resetUrl">
Acessar
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
