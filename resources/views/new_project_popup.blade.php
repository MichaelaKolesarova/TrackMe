@php use App\Models\User; @endphp
<div class="modal fade" id="ModalCreateProject" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Add New Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.new.project') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="project_name">Project Name:</label>
                        <input type="text" class="form-control" id="project_name" name="project_name" required>
                        <div class="invalid-feedback">
                            Please enter a project name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project_lead">Project Lead:</label>
                        <select class="form-control" id="project_lead" name="project_lead" required>
                            <option value="">Select Project Lead</option>
                            @foreach(User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a project lead.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
