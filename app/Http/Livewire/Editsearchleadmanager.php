<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LeadManager;

class Editsearchleadmanager extends Component
{
    public $leadmanager;
    public $query;
    public $leadmanagers = "";
    public $value;

    public function mount($lm){

        $this->query = $lm;
        $this->leadmanagers = [];
    }

    public function updatedQuery(){
        $this->leadmanagers = LeadManager::where('name','like',"%$this->query%")->get();
    }


    public function select($name){
        $this->query = $name;

        $this->leadmanagers = [];

    }
    public function render()
    {
        return view('livewire.editsearchleadmanager');
    }
}
