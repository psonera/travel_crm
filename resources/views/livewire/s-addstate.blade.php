<x-Quotation.inputs.select   name="s_state"  required class="m-1">
    @foreach ($states as $state )
        <option value="{{$state->id}}">{{$state->name}}</option>
    @endforeach
 </x-Quotation.inputs.select>