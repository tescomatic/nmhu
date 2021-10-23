<?php

namespace App\Http\Livewire;

use App\Models\Songs;
use Livewire\Component;

class SingleSong extends Component
{   public $icons=['like.svg', 'playlist2.svg', 'share.svg','quotes.svg', 'direct-download.svg','more.svg'];
    public $song= [];
    public $slug,$user;
    public function render()
    {
       $this->song= Songs::join('users','songs.userId','=','users.id')->where(['slug'=>$this->slug], ['user'=>$this->slug])->first();
        return view('livewire.single-song')->layout('main',['hide'=>false]);
    }

    public function mount($user,$slug){
        $this->slug=$slug;
        $this->user = $user;
    }
}
