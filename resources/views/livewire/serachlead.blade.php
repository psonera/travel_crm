<div>

    <x-Quotation.inputs.text wire:model='query' name="Lead" label="{{__('Lead Name')}}"   required autofocus/>
    @forelse ($leadnames  as $leadname )
    <li  wire:click="select('{{$leadname->title}}')" > {{$leadname->title}}</li>
    @empty
        NO data Found
    @endforelse
</div>
