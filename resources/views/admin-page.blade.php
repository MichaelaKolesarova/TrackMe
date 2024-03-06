@php
    use App\Helpers\DataStructures\ProjectActivitiesEnum;
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Helpers\DataStructures\EntitiesEnum;
    use App\Models\Log;
    use App\Models\Project;use App\Models\Task;use App\Models\Team;use App\Models\User;
@endphp

@extends('layouts.base')

@section('content')
    <h1 class="fw-bolder small-margin"><span class="text-gradient d-inline">Admin Page</span></h1>
    <div class="scrollable_all">

        <div class="d-flex align-items-center">
            <h5 class="small-margin fs-3 text-muted mr-auto d-inline">Admins:</h5>
            <button class="btn btn-primary ms-auto small-margin" id="addAdminBtn">Add Admin</button>
        </div>

        @foreach(User::all()->where('is_admin', true) as $admin)
            <div class="be-comment-text">
                <div class="d-flex align-items-center">
                    <div class="mr-auto d-inline">
                        <p class="a_hover small-margin">
                            <a class="text-gradient" href="{{ route('openChat', ['userId' => $admin->id]) }}">{{ $admin->name }}</a>
                        </p>
                    </div>
                    <div class="ms-auto">
                        <form method="POST" action="{{ route('removeAdmin', ['userId' => $admin->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">X</button>
                        </form>
                    </div>
                </div>
            </div>



        @endforeach
        @include('new_admin_popup')

        <div class="margin-between-sections"></div>

        <div class="d-flex align-items-center">
            <h5 class="small-margin fs-3 text-muted">projects:</h5>
            <button class="btn btn-primary ml-auto" id="addProjectBtn">Add Project</button>
        </div>
        @foreach(Project::all() as $project)
            <div class="be-comment-text">
                <div class="d-flex align-items-center">
                    <div class="mr-auto d-inline">
                        <p class="a_hover small-margin mr-2 a_hover">
                            <a class="text-gradient" href="{{ route('project_dashboard', ['project' => $project->id]) }}">{{ $project->project_name }}</a>
                        </p>
                    </div>
                    <div class="ms-auto">
                        <form method="POST" action="{{ route('removeProject', ['projectId' => $project->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">X</button>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
        @include('new_project_popup')

        <div class="margin-between-sections"></div>

        <div class="d-flex align-items-center">
            <h5 class="small-margin fs-3 text-muted">teams:</h5>
            <button class="btn btn-primary ml-auto" id="addTeamBtn">Add Team</button>
        </div>
        @foreach(Team::all() as $team)
            <div class="be-comment-text">
                <div class="d-flex align-items-center">
                    <div class="mr-auto d-inline">
                        <p class="a_hover small-margin mr-2 a_hover">
                            {{-- <a href="{{ route('project_dashboard', ['project' => $project->id]) }}">{{ $project->project_name }}</a> --}}
                            {{$team->team_name}}
                        </p>
                    </div>
                    <div class="ms-auto">
                        <form method="POST" action="{{ route('removeTeam', ['teamId' => $team->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">X</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        @include('new_team_popup')
    </div>




    <script>
        $(document).ready(function () {
            $('#addAdminBtn').click(function () {
                $('#ModalCreateAdmin').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#addProjectBtn').click(function () {
                $('#ModalCreateProject').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#addTeamBtn').click(function () {
                $('#ModalCreateTeam').modal('show');
            });
        });
    </script>

@endsection
