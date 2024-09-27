<?php

namespace App\Livewire;

use Livewire\Component;

class Clicker extends Component
{
    // ----------------- first video example
    public function clickHandel()
    {
        dd('clicked');
    }



    public function render()
    {
        return view('livewire.clicker');
    }
}
