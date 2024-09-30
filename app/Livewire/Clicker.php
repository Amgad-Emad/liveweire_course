<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Clicker extends Component
{
    #[Rule('required|min:2|max:50')]
    public  $name='';

    #[Rule('required|email|unique:users')]
    public  $email='';

    #[Rule('required|min:5')]
    public  $password='';
    public function createNewUser()
    {
        $validated=$this->validate();
        User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);
        $this->reset(
            ['name','email','password']
        );
        Request()->session()->flash('success','User Created Successfully!');
    }

    public function render()
    {
        $title="test";
        $users=User::all();
        return view('livewire.clicker',['title'=>$title,'users'=>$users]);

    }
}
