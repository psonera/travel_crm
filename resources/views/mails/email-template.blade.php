@component('mail::message')
<h1> Thrill Blazers </h1>
Hello,
<br>
This is {{ $name }},
<br>
<h1>{{ $data['subject'] }}</h1>

{{ $data['content'] }}

@component('mail::button',['url' => $data['attachment']])
View Attachment
@endcomponent


For More Information, please visit Thrill Blazers website.
@endcomponent