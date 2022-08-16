<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Qitem extends Component
{

    public $items;
    public $query;
    public $products;

    public function mount(){
        $this->items = array(array("item"=>"item","qunitity"=>"1","price"=>"12","total"=>"12"));
        $this->query = [];
    }

    public function add(){
      array_push($this->items,array("item"=>"item","qunitity"=>"1","price"=>"12","total"=>"12"));
    }
    public function updatedquery(){

        foreach($this->query as $string){
            $this->products = Product::where('name','like',"%$string%")->get('name');
        }
    }

    public function render()
    {
        return view('livewire.qitem',["items"=>$this->items]);
    }
}
