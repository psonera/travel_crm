<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use Livewire\Component;

class Editsearchlead extends Component
{
    public $query;
    public $leadnames;


    public function mount($ln){
        $this->query = $ln;
        $this->leadnames = [];
    }


    public function updatedQuery(){
        $this->leadnames = Lead::where('title','like',"%$this->query%")->limit(3)->get();
    }


    public function select($name){
        $this->query = $name;
        $this->leadnames = [];
    }
    public function render()
    {
        return view('livewire.editsearchlead');
    }
}
