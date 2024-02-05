<x-mail::message>
# Dear {{$user->firstname}} {{$user->lastname}} ({{$user->username}}),


We Confirmed your order/payment and will be delivering your items shortly.


The details of the order are below:

<x-mail::panel>
    Order Number: <strong>  {{ $order->orderRef }} </strong>
</x-mail::panel>

<x-mail::panel>
    <x-mail::table>
        | S/no | Item          | Amount    | Qty     | Total |
        |:-----|:------------- |----------:|--------:| ------:|
        @foreach($order_items as $item)
            | {{$loop->iteration}} | {{$item->name}} | {{$currency->prefix}}{{number_format($item->amount)}} | {{$item->qty}} |{{$currency->prefix}}{{number_format($item->total)}} |
        @endforeach
        |      |               |            |         |  <strong>{{$currency->prefix}}  {{ number_format($order->net_total,2) }} </strong>     |
    </x-mail::table>
</x-mail::panel>

<p style="text-decoration: underline">Store  Details:</p>
<p><strong>{{$store->name}}</strong> <br/>
    {{$store->address}} {{$store->address2}}, {{$store->city}} {{$store->state}},  {{$store->country}} <br/>
    {{$store->phone}} <br/> {{$store->email}} </p>


Total Amount: {{$currency->prefix}}  {{ number_format($order->net_total,2) }}


You will receive an email from us once your order is shipped.
Please quote your order reference number if you wish to contact us about this order.





Thanks,<br>
{{ config('app.name') }}
</x-mail::message>


