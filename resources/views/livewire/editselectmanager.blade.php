<div>
    <x-Quotation.inputs.select name="owner" label="{{ __('Manager') }}"  required>
        <option >Select Manager</option>
             @foreach ($managers as $m )
                <option value="{{$m->name}}"
                    @if ($m->name==$manager)
                        selected
                    @endif
                >{{ucwords($m->name)}}</option>
            @endforeach
    </x-inputs.select>
</div>
