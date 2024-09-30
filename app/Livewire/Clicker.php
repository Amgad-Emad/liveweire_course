<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;

    #[Rule('required|min:2|max:50')]
    public  $name = '';

    #[Rule('required|email|unique:users')]
    public  $email = '';

    #[Rule('required|min:5')]
    public  $password = '';
    public function createNewUser()
    {
        $validated = $this->validate();
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        $this->reset(
            ['name', 'email', 'password']
        );
        Request()->session()->flash('success', 'User Created Successfully!');
    }

    public function render()
    {
        $users = User::paginate(5);
        return view('livewire.clicker', ['users' => $users]);
    }
}
