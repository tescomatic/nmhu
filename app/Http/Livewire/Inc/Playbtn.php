<?php

namespace App\Http\Livewire\Inc;

use Livewire\Component;

class Playbtn extends Component
{   public $index;
     public function mount($index){
        $this->index=$index;
     }
    public function render()
    {
        return view('livewire.inc.playbtn');
    }
}
