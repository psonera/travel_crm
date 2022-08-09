<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Serachitems extends Component{

    public $query;
    public $index;
    public $name;
    public function mount($index){
        $this->index = $index;

     }
    public function updatedName(){
        if($this->name=="" || $this->name ==null){
            $this->query = [""];
        }
        foreach($this->name as $i){
         $this->query = Product::where('name','like',"%$i%")->get();
        }
    }

    public function render()
    {
        return view('livewire.serachitems');
    }
}
