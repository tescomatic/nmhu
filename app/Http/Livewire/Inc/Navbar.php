<?php

namespace App\Http\Livewire\Inc;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{   public $listeners=['refresh'=>'$refresh'];

    public $menus=[['name'=>'Profile','icon'=>'fa fa-user-circle','link'=>''],
    ['name'=>'Edit Profile','icon'=>'fa fa-edit','link'=>''],
    ['name'=>'Wallet','icon'=>'fa fa-wallet','link'=>''],
    ['name'=>'Upload','icon'=>'fa fa-upload','link'=>''],

];

public function logout(){
    Auth::logout();
    $this->emit('snack', ["Logout successful !!", ""]);
    $this->emit('refresh');
}
    public function render()
    {
        return view('livewire.inc.navbar');
    }
}
