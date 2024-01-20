

@php
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Models\Task;use App\Models\User;
@endphp

<div class="dropdown col text-end">
    <button class="col btn btn-secondary dropdown-toggle" type="button" id="assigneeDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 10px">
        <span id="chosenUserName">{{ User::find($chosenUser)->name }}</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
        @foreach(User::all() as $user)
            @if($user->id != auth()->id() && $user->id != $chosenUser)
                <a class="dropdown-item" onclick="updateChosenUser({{ $user->id }}) ">{{ $user->name }}</a>
            @endif
        @endforeach
    </div>
</div>
