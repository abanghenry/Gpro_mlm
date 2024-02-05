<x-mail::message>
# Hello Admin,

A new Testimonial post is waiting for your approval

<x-mail::button :url="$url">
View Testimonial
</x-mail::button>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
