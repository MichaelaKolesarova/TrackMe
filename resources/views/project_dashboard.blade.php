@php
    use App\Helpers\DataStructures\ProjectActivitiesEnum;
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Helpers\DataStructures\EntitiesEnum;
    use App\Models\Log;
    use App\Models\Task;use App\Models\User;
@endphp

@extends('layouts.base')

@section('content')

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
                                            {{--User::find($log->toWhat)->name--}}
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

@endsection
