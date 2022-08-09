<div>
    <x-Quotation.inputs.select name="owner" label="{{ __('Manager') }}"  required>
        <option value="">Select Manager</option>
            @foreach ($managers as $manager )
                <option value="{{$manager->name}}">{{ucwords($manager->name)}}</option>
            @endforeach
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    </x-inputs.select>
=======
    </x-Quotation.inputs.select>
>>>>>>> Stashed changes
=======
    </x-Quotation.inputs.select>
>>>>>>> Stashed changes
</div>
