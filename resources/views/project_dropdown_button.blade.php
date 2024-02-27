@php
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Models\Task;use App\Models\Team;use App\Models\User;
@endphp

<div class="dropdown col text-end">
    <button class="col btn btn-secondary dropdown-toggle" type="button" id="assigneeDropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" style="margin-left: 10px">
        <span id="chosenTeamName">{{ Team::find($chosenTeam)->team_name }}</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
        @foreach(Team::all() as $team)
            @if($team->id != $chosenTeam)
                <a class="dropdown-item" onclick="updateChosenTeam({{ $team->id }}) ">{{ $team->team_name }}</a>
            @endif
        @endforeach
    </div>
</div>
