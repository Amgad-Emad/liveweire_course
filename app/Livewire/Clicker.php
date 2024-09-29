<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Clicker extends Component
{
    // the second way to sending the data to a blade is by making the variable global
    public  $user="test user";
    public function CreateNewUser()
    {
        User::create([
            'name'=>'testname',
            'email'=>'test@email.com',
            'password'=>'password'
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
