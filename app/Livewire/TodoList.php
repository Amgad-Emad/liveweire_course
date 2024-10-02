<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;

    public $editingTodoID;

    #[Rule('required|min:3|max:50')]
    public $editingTodoName;

    public function create()
    {
        // 1- Validate
        $validatedData = $this->validateOnly('name');

        // 2- Create the new Todo task
        Todo::create($validatedData); // Pass the validated data as an array

        // 3- Reset the name field
        $this->reset('name');
        // 4- Flash success message
        session()->flash('success', 'New Todo task has been created');
        //5- reset pagination if there is
        $this->resetPage();
    }
    public function delete($id)
    {

        try {
            Todo::findOrfail($id)->delete();
        } catch (Exception $e) {
            session()->flash('error', "Failed to delete!");
            return;
        }
    }
    public function toggel(Todo $todo)
    {
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function edit($todo)
    {
        $this->editingTodoID = $todo;
        $this->editingTodoName = Todo::findOrFail($todo)->name;
    }
    public function cancel()
    {
        $this->reset('editingTodoID', 'editingTodoName');
    }
    public function update()
    {
        $this->validateOnly('editingTodoName');
        Todo::find($this->editingTodoID)->update(['name' => $this->editingTodoName]);
        $this->cancel();
    }
    public function render()
    {
        $todoLists = Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5);
        return view('livewire.todo-list', ['todoLists' => $todoLists]);
    }
}
