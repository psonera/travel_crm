@component('mail::message')
Hello,
<br>
This is {{ $name }},
From Thrill Blazers
<br>

@component('mail::panel')
{{ $data['content'] }}
@endcomponent

@component('mail::button',['url' => $data['attachment']])
View Attachment
@endcomponent


For More Information, please visit Thrill Blazers website.
@endcomponent