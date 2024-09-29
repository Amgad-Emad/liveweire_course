<div>

    <h1>{{$user}}</h1>
    <h1>{{$title}}</h1>
    {{count($users)}}
    <button wire:click="CreateNewUser">
        create new user
    </button>
</div>
