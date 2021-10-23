<?php

namespace App\Http\Livewire\Inc;

use Livewire\Component;

class Sidenav extends Component
{
    public $lists=[['name'=>'Home','icon'=>'images/home.svg','link'=>'/'],
    ['name'=>'Trending','icon'=>'images/trending.svg', 'link' => '/'],
    ['name'=>'Top Songs','icon'=>'images/fire.svg', 'link' => '/'],
    ['name'=>'Top Album','icon'=>'images/album.svg', 'link' => '/'],
    ['name'=>'Playlists','icon'=>'images/playlist.svg', 'link' => '/'],
    ['name'=>'Recently played','icon'=>'images/location.svg', 'link' => '/'],
    ['name'=>'Recently added','icon'=>'images/music.svg', 'link' => '/'],
    ['name'=>'Follow','icon'=>'images/add.svg', 'link' => '/']];
    public $settings;
    public function render()
    {
        return view('livewire.inc.sidenav');
    }
}
