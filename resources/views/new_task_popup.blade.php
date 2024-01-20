@php use App\Helpers\DataStructures\PriorityEnum;use App\Helpers\DataStructures\TaskStatusEnum;use App\Models\User; @endphp

<div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
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

                <form action="{{ route('create.task') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Task Title:</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <div class="invalid-feedback">
                            Please provide a task title.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Task Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="assignee_id">Assignee:</label>
                        <select class="form-control" id="assignee_id" name="assignee" required>
                            <option value="">Select Assignee</option>
                            @foreach(User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                            <option value="0">unassigned</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select an assignee.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" class="form-control" id="due_date" name="dueDate">
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="taskStatus">
                            @foreach(TaskStatusEnum::cases() as $status)
                                <option value="{{ $status }}">{{TaskStatusEnum::toString($status)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select class="form-control" id="priority" name="priority">
                            @foreach(PriorityEnum::cases() as $priority)
                                <option value="{{ $priority }}">{{PriorityEnum::toString($priority)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary small-margin">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

