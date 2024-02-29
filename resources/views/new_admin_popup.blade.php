@php use App\Helpers\DataStructures\PriorityEnum;use App\Helpers\DataStructures\TaskStatusEnum;use App\Models\Project;use App\Models\Task;use App\Models\User; @endphp

<div class="modal fade" id="ModalCreateAdmin" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
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

                <form action="{{ route('add.new.admin') }}" method="POST">
                    @csrf


                    <div class="form-group">
                        <label for="assignee_id">new admin:</label>
                        <select class="form-control" id="assignee_id" name="assignee" required>
                            <option value="">select admin</option>
                            @foreach(User::all()->where('is_admin', false) as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select an admin.
                        </div>
                    </div>

                    <button class="btn btn-primary small-margin">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>

