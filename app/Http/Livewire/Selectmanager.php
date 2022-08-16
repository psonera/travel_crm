<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Selectmanager extends Component
{

    public  $managers = [];


    public function mount(){
        $this->managers = User::role('Manager')->get();
    }


    public function render()
    {
        return view('livewire.selectmanager');
    }
}
