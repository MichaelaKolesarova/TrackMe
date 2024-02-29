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

    <div class="d-flex align-items-center">
        <h5 class="small-margin fs-3 text-muted">Admins:</h5>
        <button class="btn btn-primary ml-auto" id="addAdminBtn">Add Admin</button>
    </div>
    @foreach(User::all()->where('is_admin', true) as $admin)
        <div class="d-flex align-items-center">
            <p class="a_hover small-margin mr-2">
                <a href="{{ route('openChat', ['userId' => $admin->id]) }}">{{ $admin->name }}</a>
            </p>
            <form method="POST" action="{{ route('removeAdmin', ['userId' => $admin->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">X</button>
            </form>
        </div>
    @endforeach
    @include('new_admin_popup')

    <div class="margin-between-sections"></div>

    <div class="d-flex align-items-center">
        <h5 class="small-margin fs-3 text-muted">projects:</h5>
        <button class="btn btn-primary ml-auto" id="addProjectBtn">Add Project</button>
    </div>
    @foreach(Project::all() as $project)
        <div class="d-flex align-items-center">
            <p class="a_hover small-margin mr-2">
                <a href="{{ route('project_dashboard', ['project' => $project->id]) }}">{{ $project->project_name }}</a>
            </p>
            <form method="POST" action="{{ route('removeProject', ['projectId' => $project->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">X</button>
            </form>
        </div>
    @endforeach
    @include('new_project_popup')

    <div class="margin-between-sections"></div>

    <div class="d-flex align-items-center">
        <h5 class="small-margin fs-3 text-muted">teams:</h5>
        <button class="btn btn-primary ml-auto" id="addTeamBtn">Add Team</button>
    </div>
    @foreach(Team::all() as $team)
        <div class="d-flex align-items-center">
            <p class="a_hover small-margin mr-2">
                {{-- <a href="{{ route('project_dashboard', ['project' => $project->id]) }}">{{ $project->project_name }}</a> --}}
                {{$team->team_name}}
            </p>
            <form method="POST" action="{{ route('removeTeam', ['teamId' => $team->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">X</button>
            </form>
        </div>
    @endforeach
    @include('new_team_popup')



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






    {{--

    <div class="container-fluid small-margin">
        <div class="col ">
            <div class="row">
                <div class="row small-margin">
                    <h1 class="col display-3 fw-bolder"><span
                            class="text-gradient d-inline">Project {{$project->project_name}}</span></h1>

                    <a class="col col-lg-3 btn btn-primary fw-bolder small-margin d-flex align-items-center justify-content-center"
                       data-bs-toggle="modal" data-bs-target="#ModalCreate">New Task</a>
                </div>


                <h5 class="small-margin fs-3 text-muted"> ID: <span style="color: #1a1e21">{{$project->id}} </span></h5>
                <h5 class="fs-3 text-muted small-margin">Project lead: <span class=" a_hover">
                        <a class="text-gradient" href="{{ route('openChat', ['userId' => $project->project_lead]) }}"
                            style="color: #1a1e21">{{User::find($project->project_lead)->name}}</a></span></h5>

                <div class="col small-margin scrollable">
                    <!--TODO tu ide progress bar - workflows-->
                    <div class="fs-3 fw-light text-muted">progress bar</div>


                    <!--ASSIGNED To OTHER TEAM MEMBERS-->

                    <div class="fs-3 fw-light text-muted">tasks by teams</div>
                    <div class="row">
                        @php
                            $defaultTeamId =1;
                            $chosenTeam = $defaultTeamId;
                        @endphp

                        <div id="button">
                            @include('project_dropdown_button', ['chosenTeam' => $chosenTeam ])
                        </div>

                    </div>
                    <div style="margin: 50px"></div>

                    <div id="cards">
                        @include('project_dashboard_specific_team_content', ['chosenTeam' => $chosenTeam ])
                    </div>

                </div>


                <div class="col-3 small-margin ml-auto scrollable">

                    <p>Teams working on project: </p>
                    @foreach($project->teams as $team)
                        <p class="text-gradient small-margin">{{$team->team_name}}</p>
                    @endforeach

                    <p>Project Log: </p>
                    <div class="align-items-start margin-between-sections">
                        @foreach(Log::where('entity_id', $project->id)->where('entity_type', EntitiesEnum::Project)->get() as $log)
                            <p>
                                <span class="a_hover">
                                    <a class="text-gradient" href="{{ route('openChat', ['userId' => $log->who]) }}">{{ $log->getWhoName() }}</a>
                                </span>
                                {{ ProjectActivitiesEnum::toString(ProjectActivitiesEnum::from($log->changedWhat)) }}
                                <span class="text-body-emphasis a_hover">
                                    @if($log->changedWhat != null)
                                        @if(ProjectActivitiesEnum::from($log->changedWhat) == ProjectActivitiesEnum::UpdateTeamLead)
                                            --User::find($log->toWhat)->name
                                        @elseif(ProjectActivitiesEnum::from($log->changedWhat) == ProjectActivitiesEnum::CreatedNewRootTask)
                                            <a class="text-gradient" href="{{ route('task.overview', ['task' => $log->toWhat]) }}">{{ Task::find($log->toWhat)->title }}</a>
                                        @elseif(ProjectActivitiesEnum::from($log->changedWhat) == ProjectActivitiesEnum::CreatedNewSubtask)
                                            <a class="text-gradient" href="{{ route('task.overview', ['task' => $log->toWhat]) }}">{{ Task::find($log->toWhat)->title }}</a>
                                        @else
                                            Unknown state
                                        @endif
                                    @endif
                                </span>
                            </p>
                        @endforeach

                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        function updateChosenTeam(teamId) {

//cards s  úlohami
            $.ajax({
                type: 'POST',
                url: '/update-chosen-team',
                data: {teamId: teamId},
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                success: function (response) {
                    document.getElementById('cards').innerHTML = '';
                    document.getElementById('cards').innerHTML = response;
                    document.getElementById('assigneeDropdown').click();

                }
            });

            //meno na buttone
            $.ajax({
                type: 'POST',
                url: '/update-button-project',
                data: {teamId: teamId},
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                success: function (response) {
                    document.getElementById('button').innerHTML = '';
                    document.getElementById('button').innerHTML = response;
                }
            });

            document.getElementById('button').innerHTML = response;

        }

    </script>
    @include('new_task_popup')



                                            --}}

@endsection
