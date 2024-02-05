<x-mail::message>


# Hello {{$user->firstname}},

<p>Congratulation</p>
<p>Your Just qualified for a new award <br/>
{{$usersAward->description}} </p>

<p>Award name: <b>{{$award['name']}}</b>  <br/>
   Cash Equivalent: <b>{{ number_format($award['cash_equivalent']) }} </b> <br/>
   New Rank: <b>{{$award['rank']}}</b> <br/>
   <img src="{{$url_award_logo}}" style="max-height: 220px; padding: 20px">
</p>


Warm Regards,<br>
{{ config('app.name') }}
</x-mail::message>
