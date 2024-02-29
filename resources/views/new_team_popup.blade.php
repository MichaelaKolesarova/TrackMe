@php use App\Models\User; @endphp
<div class="modal fade" id="ModalCreateTeam" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teamModalLabel">Add New Team</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.new.team') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="team_name">Team Name:</label>
                        <input type="text" class="form-control" id="team_name" name="team_name" required>
                        <div class="invalid-feedback">
                            Please enter a team name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="team_lead">Team Lead:</label>
                        <select class="form-control" id="Team_lead" name="team_lead" required>
                            <option value="">Select Team Lead</option>
                            @foreach(User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a team lead.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
