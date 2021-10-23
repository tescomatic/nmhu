<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class Upload extends Component
{
    public $amount=[1];
    public $listeners=['another'=>"anothers","reduse"=>"reduse"];

    public function anothers(){
        $this->amount[]=count($this->amount) + 1;

    }

    public function mount(){

        if (!Auth::check()) {

            return redirect()->to('/');
            return $this->emit('snack', ['Please login first ','']);
        }
    }
    public function hydrate()
    {

        if (!Auth::check()) {

         $this->emit('snack', ['Please login first ', '']);
            return redirect()->to('/');
        }
    }
    public function reduse($i)
    {
        //array_splice($this->amount, $i, 1);
        unset($this->amount[2]);
    }
    public function render()
    {
        return view('livewire.upload')->layout('main',["hide"=>true]);
    }
}
