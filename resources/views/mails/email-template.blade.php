@component('mail::message')
Hello,
<br>
This is {{ $name }},
<br>
From Thrill Blazers
<br>

Message: {!! $data['content'] !!}

For More Information, please visit Thrill Blazers website.
@endcomponent
