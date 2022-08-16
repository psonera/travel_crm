<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Editselectmanager extends Component

{

    public $manager;
    public  $managers = [];

    public function mount($manager){

        $this->manager = $manager;
        $this->managers = User::role('Manager')->get();
    }

    public function render()
    {
        return view('livewire.editselectmanager');
    }
}
