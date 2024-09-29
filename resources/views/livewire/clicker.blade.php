<div>
    <form wire:submit='createNewUser' action="">
        <input wire:model="name" type="text" placeholder="name">
        <input wire:model="email" type="email" placeholder="email" >
        <input wire:model="password" type="password" placeholder="password" >
        <button>create</button>
    </form>
    <hr>
    @foreach ($users as $user)
        <h3>{{ $user->name }}</h3>
    @endforeach
</div>
