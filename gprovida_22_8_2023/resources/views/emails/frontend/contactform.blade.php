<x-mail::message>
# Contact form message


Name: {{$name}}<br>
Email: {{$email}}<br>
message: {{$message}}


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
