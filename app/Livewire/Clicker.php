<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Clicker extends Component
{
    public  $name;
    public  $email;
    public  $password;
    public function createNewUser()
    {
        User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password
        ]);
    }

    public function render()
    {
        // there is three ways to pass the data into the livewire blade

        $title="test";
        $users=User::all();
        // the First way
        return view('livewire.clicker',['title'=>$title,'users'=>$users]);
        // or
        // return view('livewire.clicker',compact('title'));
    }
}
