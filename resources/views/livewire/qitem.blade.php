<div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>item</th>
                    <th>quntity</th>
                    <th>price</th>
                    <th>total</th>
                </tr>
            </thead>
             <tbody>
            <div>
                @foreach ($items as $key=>$item )
                    <tr>
                        <td><input class="border "  type="text" wire:model="query.{{$loop->index}}" name="item"  value="{{$loop->index}}">
                            {{$products}}
                        </td>
                        <td><input class="border "  type="text" name="quntity"  value="{{$loop->index}}"></td>
                        <td><input  class="border " type="text" name="price"  value="{{$loop->index}}"></td>
                        <td><input class="border "  type="text" name="total"  value="{{$loop->index}}"></td>
                    </tr>
                @endforeach
                </div>
            </tbody>
        </table>
    </div>
    <div>
      <button wire:click.prevent="add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">add</button>
    </div>
</div>
