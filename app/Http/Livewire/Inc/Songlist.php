<?php

namespace App\Http\Livewire\Inc;

use App\Models\Songs;
use Livewire\Component;
use Illuminate\Support\Arr;

class Songlist extends Component
{
    protected $listeners = [
        'load-mores' => 'loadMore'

    ];
    public $img = [1, 1, 1, 1, 1, 1];
    public $offset = 0;
    public $songs = [];
    public function loadMore()
    {
        $this->offset += 5;
    }
    public function mount()
    {
    }

    public function dehydrate()
    {
        //$this->emit('remake',$this->songs);
    }

    public function render()

    {
        $songs = Songs::join('users', 'songs.userId', '=', 'users.id')->latest('songs.created_at')
            ->skip($this->offset)->take(5)->get();

        foreach ($songs as $song) {
            $this->songs[] = $song;
        }


        return view('livewire.inc.songlist')->layout('main', ['hide' => false]);
    }
}
