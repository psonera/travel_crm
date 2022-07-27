<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Quotationitems extends Component
{

    public $items = [];
    public $item;
    public $quntity;
    public $price;
    public $amount;
    public $discount;
    public $tax;
    public $total;
    public $products = [];
    public $i = 0;

    public function mount(){
        $this->items[] = ["key"=>$this->i];
        $this->products = [];
    }

    public function additem(){
        $this->i++;
        array_push($this->items,array("key"=>$this->i));
    }


    public function updatedItem(){
       foreach($this->item as $i){
           $this->products = $i==""?Product::where('name','like',"%$i%")->get():[""];
       }
    }

    public function select($name){

    }

    public function render()
    {
        return view('livewire.quotationitems');
    }


}
