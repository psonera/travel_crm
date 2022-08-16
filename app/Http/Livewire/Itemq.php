<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Itemq extends Component
{

    public $items;
    public $query;
    public $name;
    public $quntity;
    public $price;
    protected $listeners = [
        'childToparent'
     ];


    public function mount(){
        $this->items = array(["name"=>"","quntity"=>1]);
        $this->name = [];
        $this->query = array();
    }

    public function add(){
        $this->items[] = ["name"=>"","quntity"=>1];
    }


    public function childToparent($value){
        $this->quntity = $value[0];
        $this->price = $value[1];
        $this->name[0] = $value[2];

    }

    public function updating(){
        $this->query = null;
    }
    public function remove($index){

        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }
    public function render()
    {
        return view('livewire.itemq');
    }
}
