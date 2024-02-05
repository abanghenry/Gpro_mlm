<x-mail::message>
<a href="{{$url_home}}" target="_blank" rel="noreferrer">
    <img src="{{$url_logo}}"
         style="max-height: 110px; padding: 20px"  alt="{{ config('app.name') }}">
</a>
<br><br>

# Hello {{$user->firstname}},

<p>Your order has been shipped</p>

<br>
<p>
----------------------------------------------<br>
Order Ref: #{{ $order->orderRef }}<br>
Store: <br>
       {{ $order->store->name }}<br>
       {{ $order->store->address }} {{ $order->store->address }}<br>
       {{ $order->store->city }}, {{ $order->store->state }},  {{ $order->store->country }}<br>

No of Items: <span>{{$order->number_of_items }}</span><br>
----------------------------------------------
</p>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
