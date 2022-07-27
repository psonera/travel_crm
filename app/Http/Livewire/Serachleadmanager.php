<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Serachleadmanager extends Component
{
    public $query;
    public $leadmanagers = "";
    public $value;
    public function mount(){
        $this->query = "";
        $this->leadmanagers = [];

    }

    public function updatedQuery(){
        $this->leadmanagers = User::role('LeadManager')->where('name','like',"%$this->query%")->get();
    }


    public function select($name){
        $this->query = $name;

    }

    public function render()
    {
        return view('livewire.serachleadmanager');
    }
}
