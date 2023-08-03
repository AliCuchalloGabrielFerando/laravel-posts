<x-mail::message>
# Tus Credenciales para acceder a {{config('app.name')}}

Utiliza estas crendenciales para entrar al.
<x-mail::table>
| Usuario       | Contraseña        | 
| :--- |:----|
|{{$user->email}}     | {{$password}}      |

</x-mail::table>
<x-mail::button :url="'login'">
Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
