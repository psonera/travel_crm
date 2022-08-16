<div>
    <div>
        <x-inputs.text  name="itemname"   wire:model="name.{{$index}}"/>
    </div>
    @if ($query!=null)
        <ul>
            @foreach ($query as $itemname)
                <li wire:click="$emit(addEmit({{$itemname}},{{$index}}))" class="border bg-gray-100">{{$itemname->name}}</li>
                <hr>
            @endforeach
        </ul>
    @endif
    
</div>
