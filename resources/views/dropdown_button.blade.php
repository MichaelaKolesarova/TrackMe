

@php
    use App\Models\User;
    use App\Models\Team;
@endphp

<div class="dropdown col text-end">
    <button class="col btn btn-secondary dropdown-toggle" type="button" id="assigneeDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 10px">
        <span id="chosenUserName">{{ User::find($chosenUser)->name }}</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="userDropdown">


        @if($teamInstance = Team::find($chosenTeam))
            @foreach(User::all() as $user)
                @if($user->id != $chosenUser)
                    <a class="dropdown-item" onclick="updateChosenUser({{ $user->id }}, {{$chosenTeam}}) ">{{ $user->name }}</a>
                @endif
            @endforeach

        @endif
    </div>
</div>
