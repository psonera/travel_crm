<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchProduct extends Component
{
    public $products = "";
    public $price;
    public $quantity;
    public $amount;
    public $search = '';

    public function render()
    {
        return view('livewire.search-product');
    }
}
