<?php

namespace App\Http\Livewire\Inc;

use Livewire\Component;

class Share extends Component
{
    public $color = 'sidenav-icon';
    public $listeners = ['share' => 'shares'];
    public $info = '';
    public $embed = false;

    public function shares($info)
    {

        $this->embed = false;
        $info['description'] == '' ? $info['description'] = "Stream, share and download my new song on naipod.com" : '';
        $this->info = $info;

        // dd($this->info);
    }
    public function render()
    {
        return view('livewire.inc.share');
    }
}
