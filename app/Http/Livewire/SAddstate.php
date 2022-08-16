<?php

namespace App\Http\Livewire;

use App\Models\State;
use Livewire\Component;

class SAddstate extends Component
{

    public $states;


    public function mount(){
        $this->states = State::all();
    }

    public function render()
    {
        return view('livewire.s-addstate');
    }
}
