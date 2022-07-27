<div>
    <x-Quotation.inputs.text wire:model="query" name="person" label="{{__('Lead Manager')}}" value="{{old('')}}" required autofocus/>

    @forelse ($leadmanagers as $manager )
       <li  wire:click="select('{{$manager->name}}')"> {{$manager->name}}</li>
    @empty
          NO data Found
    @endforelse

</div>
