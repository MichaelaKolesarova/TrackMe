@php use App\Helpers\DataStructures\PriorityEnum;use App\Helpers\DataStructures\TaskStatusEnum;use App\Models\Project;use App\Models\Task;use App\Models\User; @endphp

<div class="modal fade" id="ModalCreateNewTeamMember" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Insert Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('add.team.member') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="team_member">new team member:</label>
                        <select class="form-control" id="user" name="user" required>
                            <option value="">select new team member</option>
                            @foreach($team->usersNotInTeam()->get() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select an admin.
                        </div>
                    </div>
                    <input type="hidden" name="team" value="{{ $team->id }}">
                    <button class="btn btn-primary small-margin">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>

