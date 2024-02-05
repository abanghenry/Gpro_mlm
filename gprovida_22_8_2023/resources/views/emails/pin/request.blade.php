<x-mail::message>
<a href="{{$url_home}}" target="_blank" rel="noreferrer">
    <img src="{{$url_logo}}"
         style="max-height: 110px; padding: 20px"  alt="{{ config('app.name') }}">
</a>
<br><br>
# Dear {{$user->firstname}} {{$user->lastname}} ({{$user->username}}),

We have received your Pin Request and will be processing it shortly.

PLEASE NOTE: <strong>ALL BANK DEPOSIT PAYMENTS MUST BE PAID WITH YOUR USERNAME AS THE DEPOSITOR</strong>

The details of the order are below:


<x-mail::panel>
    Request Ref: <strong>  {{ 576244+$pinrequest->id }} </strong>
</x-mail::panel>

<x-mail::panel>
<p style="text-decoration: underline">Request  Details:</p>
<p>
<strong>Package</strong> {{$pinrequest->package->name}}<br/>
<strong>Quantity</strong> {{$pinrequest->quantity}}<br/>
<strong>Amount Paid</strong> {{$pinrequest->currency->prefix}}{{number_format($pinrequest->amount_paid,2)}}<br/>
<strong>Account Number</strong>  {{$pinrequest->account_number}}<br/>
<strong>Bank</strong> {{$pinrequest->bank}}<br/>
</p>
</x-mail::panel>



You will receive an email from us shortly once your payment is confirmed.
Please quote your order reference number if you wish to contact us about this order.


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
