<?php

namespace App\Http\Livewire\Inc;

use Illuminate\Http\Client\Request;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class Social extends Component
{
    public $social;
    public function mount($social){
try {

            if ($social == 'twitter') {
                $userSocial = Socialite::driver($social)->user();
                $type = 'twitter';
            } else {
                $userSocial = Socialite::driver($social)->stateless()->user();
                $type = 'others';
            }
            session()->put('socials', ['user' => $userSocial, 'type' => $type]);

            echo "<script type='text/javascript'>window.close()</script>";
            $this->emit('closeWindow');
            //dd($userSocial);
            return;
} catch (\Throwable $th) {
            echo "<script type='text/javascript'>window.close()</script>";
            $this->emit('closeWindow');
            return;
}




    }
    public function render()
    {

        return view('livewire.inc.social')->layout('main', ['hide' => true]);
    }
}
