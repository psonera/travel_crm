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

    public function updatedSelectedProduct($value){
        $this->price = Product::where('id', $value)->first()->price;
        $this->quantity = Product::where('id', $value)->first()->quantity;
        $this->amount = Product::where('id', $value)->first()->amount;
    }

    public function render()
    {
        sleep(1);
        $products = Product::search($this->products)->all();

        $data = [
            'products' => $products,
        ];

        return view('forms.add_product', $data);
    }
}
