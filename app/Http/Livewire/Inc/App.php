<?php

namespace App\Http\Livewire\Inc;

use Livewire\Component;

class App extends Component
{
    public function render()
    {
        return view('livewire.inc.app')->extends('main')->section('main');
    }
}
