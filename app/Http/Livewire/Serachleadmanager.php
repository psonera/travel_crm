<?php

namespace App\Http\Livewire;

use App\Models\LeadManager;
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

        $this->leadmanagers = LeadManager::where('name','like',"%$this->query%")->get();

            $this->leadmanagers = LeadManager::where('name','like',"%$this->query%")->take(3)->get();

    }


    public function select($name){
        $this->query = $name;



        $this->leadmanagers = [];

    }

    public function render()
    {
        return view('livewire.serachleadmanager');
    }
}
