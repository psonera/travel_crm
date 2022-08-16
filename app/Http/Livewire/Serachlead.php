<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use Livewire\Component;

class Serachlead extends Component
{
    public $query;
    public $leadnames;


    public function mount(){
        $this->query = "";
        $this->leadnames = [];
    }


    public function updatedQuery(){

        $this->leadnames = Lead::where('title','like',"%$this->query%")->get();

        $this->leadnames = Lead::where('title','like',"%$this->query%")->limit(3)->get();

    }


    public function select($name){
        $this->query = $name;


        $this->leadnames = [];

    }


    public function render()
    {
        return view('livewire.serachlead');
    }
}
