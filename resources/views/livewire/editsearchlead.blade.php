<div>

    <x-Quotation.inputs.text wire:model='query' name="Lead" label="{{__('Lead Name')}}"    autofocus/>

    @if ($query!="")
    <div class="flex">
        <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
            @foreach ($leadnames  as $leadname )
             <li  wire:click="select('{{$leadname->title}}')" class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"> {{$leadname->title}}</li>
            @endforeach
        </ul>
    </div>
   @endif

</div>
