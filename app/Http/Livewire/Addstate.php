<?php

namespace App\Http\Livewire;

use App\Models\State;
use Livewire\Component;

class Addstate extends Component
{

    public $states;


    public function mount(){
        $this->states = State::all();
    }


    public function render()
    {
        return view('livewire.addstate');
    }
}
