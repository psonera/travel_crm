<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchProduct extends Component
{
    public function render()
    {
        sleep(1);
        $products = Product::search($this->term)->paginate(10);

        $data = [
            'products' => $products,
        ];

        return view('livewire.search-product', $data);
    }
}
