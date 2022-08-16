<div>
    <table>
        <thead>
            <th>Name</th>
            <th>Quntity</th>
            <th>price</th>
            <th>total</th>
        </thead>
        <tbody>

            @foreach($items as $index=>$item)

                <div >
                    <tr>
                        <td>
                            <div>
                                <livewire:serachitems    :index="$index" wire:key='{{$index}}'  />
                            </div>
                        </td>

                        <td><x-inputs.text name="item" wire:model="quntity" /></td>
                        <td><x-inputs.text name="itemprice" wire:model="price" /></td>
                        <td><x-inputs.text name="itemtotal" /></td>
                        @if (!$loop->first)
                            <td><button wire:click="remove({{$index}})" class="button bg-red-500">delete</button></td>
                        @endif

                    </tr>

                </div>

            @endforeach

        </tbody>

       <tfoot>
        <td><button class="button" wire:click.prevent='add'>add</button></td>
       </tfoot>
    </table>

</div>
