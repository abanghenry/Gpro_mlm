<x-mail::message>
<a href="{{$url_home}}" target="_blank" rel="noreferrer">
    <img src="{{$url_logo}}"
         style="max-height: 110px; padding: 20px"  alt="{{ config('app.name') }}">
</a>
<br><br>

# Hello {{$user->firstname}},

{{ $reply->message }}

<br>
<p>
    ----------------------------------------------<br>
    Ticket ID: #{{ $parent->ticket_id }}<br>
    Subject: {{ $parent->subject }}<br>
    Status: <span style="color:{{$parent->status->color}}">{{$parent->status->name}}</span><br>
    Ticket URL: <a href="{{$url}}" target="_blank" rel="noreferrer">{{$url}}</a> <br/>
    ----------------------------------------------
</p>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
