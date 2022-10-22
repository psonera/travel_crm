@component('mail::message')
@if($created)
    You have a new activity, please find the details below:
@else
    This activity has been modified, please find the details below:
@endif

    @foreach ($activity_data as $key => $value)
        {{ ucfirst(trans($key)) }}      -       {{ $value }}
    @endforeach


Thanks,
Thrill Blazers.
@endcomponent