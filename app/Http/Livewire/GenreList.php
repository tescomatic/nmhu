<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GenreList extends Component
{
    public $list = ['Fuji','Regae','Hip hop','Dance hall','Tungba','Apala','Afro','Afro juju','Regae','Hip hop','Dance hall','Tungba','Apala','Afro','Afro juju','Dance hall','Tungba','Apala','Afro','Afro juju','Regae','Hip hop','Dance hall','Tungba','Apala','Afro','Afro juju','Dance hall','Tungba','Apala','Afro','Afro juju','Regae','Hip hop','Dance hall','Tungba','Apala','Afro','Afro juju'];

    public function render()
    {
        return view('livewire.genre-list');
    }
}
