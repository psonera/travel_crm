<label class="{{ ($required ?? false) ? 'label label-required  text-gray-700' : 'label p-2 font-semibold text-gray-700' }}" for="{{ $name }}">
    {{ $label }} 
    @if($required ?? true)
        <span class="text-red-500">*</span>
    @endif    
</label>