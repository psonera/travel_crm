<div>
    <x-Quotation.inputs.text wire:model="query" name="person" label="{{__('Lead Manager')}}" value="" required autofocus />
    @if ($query!="")
   <div class="flex">
    <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
        @foreach ($leadmanagers as $manager )
        <li wire:click="select('{{$manager->name}}')" class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg">{{$manager->name}}</li>
     @endforeach
    </ul>
  </div>
   @endif

</div>
