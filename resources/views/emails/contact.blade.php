@component('mail::message')
# New Website Contact
### From {{$client_name}} representing {{$business_name}}

Callback number: {{$client_phone}}

"{{$message_body}}"

@component('mail::button', ['url' => 'mailto:' . $client_email])
Reply to {{$client_email}}
@endcomponent

@endcomponent