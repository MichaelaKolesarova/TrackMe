@php
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Helpers\DataStructures\EntitiesEnum;
    use App\Models\Task;
@endphp

@extends('layouts.base')

@section('content')
    <div class="row small-margin">
        <h1 class="col display-3 fw-bolder"><span
                class="text-gradient d-inline">{{$team->team_name}} team dashboard</span></h1>

        <a class="col col-lg-3 btn btn-primary fw-bolder small-margin d-flex align-items-center justify-content-center"
           data-bs-toggle="modal" data-bs-target="#ModalCreate">New Task</a>
        <h5 class="fs-3 text-muted ">project documentation: <span class=" a_hover">
                        <a class="text-gradient" href="{{ route('open-documentation', ['entityType' => EntitiesEnum::Team, 'entityId' => $team->id]) }}"
                           style="color: #1a1e21">here</a></span></h5>
        <div class="fs-3 fw-light text-muted">unassigned</div>
    </div>
    <div style="margin: 50px"></div>
    <div class="row">
        <div class="scrollable_all col">

            <div id="tasks_container" class="col fill-width small-margin ">
                <div class="row justify-content-around">
                    <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                        <div class="card tasks-card">
                            <div class="card-body">
                                <div>
                                    <span class="card-title-text">TO DO</span>
                                    <span class="badge bg-secondary right brown">{{Task::all()->whereNull('assignee')->where('taskStatus', TaskStatusEnum::ToDo->value)->count() }} tasks</span>
                                </div>

                                <div taskStatus="{{TaskStatusEnum::ToDo}}" id="card-tasks-todo" class="min-height">

                                    @foreach(Task::all()->whereNull('assignee')->where('taskStatus', TaskStatusEnum::ToDo->value)->where('team_assigned_to', $team->id) as $task)
                                        <div id="{{$task->id}}" class="task-card" draggable="true">
                                            <div class="task-name fill-width row">
                                                <a href="{{ route('task.overview', ['task' => $task->id]) }}"
                                                   class="task-title task-link" draggable="false">
                                                    <span>{{$task->title}}</span>
                                                    @if ($task->priority == 1)
                                                        <i class="bi bi-egg-fried"></i>
                                                    @elseif ($task->priority == 2)
                                                        <i class="bi bi-egg-fried"></i>
                                                    @elseif ($task->priority == 3)
                                                        <i class="bi bi-droplet"></i>
                                                    @elseif ($task->priority == 4)
                                                        <i class="bi bi-snow2"></i>
                                                    @endif


                                                    <div class="dropdown right">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor"
                                                             class="bi bi-three-dots-vertical dropdown-toggle"
                                                             role="button"
                                                             id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                             aria-expanded="false"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        </svg>

                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                        <div class="card tasks-card">
                            <div class="card-body">
                                <div>
                                    <span class="card-title-text">IN PROGRESS</span>
                                    <span
                                        class="badge bg-secondary right brown">{{Task::all()->whereNull('assignee')->where('taskStatus',  TaskStatusEnum::InProgress->value)->count()}} tasks</span>
                                </div>

                                <div taskStatus="{{TaskStatusEnum::InProgress}}" id="card-tasks-inprogres"
                                     class="min-height">

                                    @foreach(Task::all()->whereNull('assignee')->where('taskStatus', TaskStatusEnum::InProgress->value)->where('team_assigned_to', $team->id) as $task)
                                        <div id="{{$task->id}}" class="task-card" draggable="true">
                                            <div class="task-name fill-width row">
                                                <a href="{{ route('task.overview', ['task' => $task->id]) }}"
                                                   class="task-title task-link" draggable="false">
                                                    <span>{{$task->title}}</span>
                                                    @if ($task->priority == 1)
                                                        <i class="bi bi-egg-fried"></i>
                                                    @elseif ($task->priority == 2)
                                                        <i class="bi bi-egg-fried"></i>
                                                    @elseif ($task->priority == 3)
                                                        <i class="bi bi-droplet"></i>
                                                    @elseif ($task->priority == 4)
                                                        <i class="bi bi-snow2"></i>
                                                    @endif

                                                    <div class="dropdown right">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor"
                                                             class="bi bi-three-dots-vertical dropdown-toggle"
                                                             role="button"
                                                             id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                             aria-expanded="false"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        </svg>

                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                        <div class="card tasks-card">
                            <div class="card-body">
                                <div>
                                    <span class="card-title-text">BLOCKED</span>
                                    <span
                                        class="badge bg-secondary right brown">{{Task::all()->where('taskStatus', TaskStatusEnum::Blocked->value)->count()}} tasks</span>
                                </div>

                                <div taskStatus="{{TaskStatusEnum::Blocked}}" id="card-tasks-blocked"
                                     class="min-height">

                                    @foreach(Task::all()->whereNull('assignee')->where('taskStatus', TaskStatusEnum::Blocked->value)->where('team_assigned_to', $team->id) as $task)
                                        <div id="{{$task->id}}" class="task-card" draggable="true">
                                            <div class="task-name fill-width row">
                                                <a href="{{ route('task.overview', ['task' => $task->id]) }}"
                                                   class="task-title task-link" draggable="false">
                                                    <span>{{$task->title}}</span>
                                                    @if ($task->priority == 1)
                                                        <i class="bi bi-egg-fried"></i>
                                                    @elseif ($task->priority == 2)
                                                        <i class="bi bi-egg-fried"></i>
                                                    @elseif ($task->priority == 3)
                                                        <i class="bi bi-droplet"></i>
                                                    @elseif ($task->priority == 4)
                                                        <i class="bi bi-snow2"></i>
                                                    @endif

                                                    <div class="dropdown right">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor"
                                                             class="bi bi-three-dots-vertical dropdown-toggle"
                                                             role="button"
                                                             id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                             aria-expanded="false"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        </svg>

                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                        <div class="card tasks-card">
                            <div class="card-body">
                                <div>
                                    <span class="card-title-text">DONE</span>
                                    <span
                                        class="badge bg-secondary right brown">{{Task::all()->whereNull('assignee')->where('taskStatus', TaskStatusEnum::Done->value)->count()}} tasks</span>
                                </div>

                                <div taskStatus="{{TaskStatusEnum::Done}}" id="card-tasks-done" class="min-height">
                                    @foreach(Task::all()->whereNull('assignee')->where('taskStatus', TaskStatusEnum::Done->value) as $task)
                                        <div id="{{$task->id}}" class="task-card" draggable="true"
                                             onclick="/get-task/{{$task->id}}">
                                            <div class="task-name fill-width row">
                                                <a href="{{ route('task.overview', ['task' => $task->id]) }}"
                                                   class="task-title task-link" draggable="false">
                                                    <span>{{$task->title}}</span>
                                                    @if ($task->priority == 1)
                                                        <i class="bi bi-egg-fried"></i>
                                                    @elseif ($task->priority == 2)
                                                        <i class="bi bi-egg-fried"></i>
                                                    @elseif ($task->priority == 3)
                                                        <i class="bi bi-droplet"></i>
                                                    @elseif ($task->priority == 4)
                                                        <i class="bi bi-snow2"></i>
                                                    @endif


                                                    <div class="dropdown right">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor"
                                                             class="bi bi-three-dots-vertical dropdown-toggle"
                                                             role="button"
                                                             id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                             aria-expanded="false"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        </svg>

                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!--ASSIGNED To OTHER TEAM MEMBERS-->


            <div class="row small-margin">
                @php
                    $defaultUserId = (auth()->id() == 1) ? 2 : 1;
                    $chosenUser = $defaultUserId;
                @endphp
                <div class="fs-3 fw-light text-muted col">other team members</div>

                <div id="button">
                    @include('dropdown_button', ['chosenUser' => $chosenUser, 'chosenTeam'  => $team->id])
                </div>

            </div>

            <div style="margin: 50px"></div>

            <div id="cards">
                @include('team_dashboard_specific_member_content', ['chosenUser' => $chosenUser, 'chosenTeam'  => $team->id])
            </div>
        </div>

        <div class="col-3 scrollable">
            <div class="d-flex align-items-center">
                <p>Team members</p>
                @if(auth()->user()->is_admin || auth()->id == $team->team_lead) @endif
                <button class="btn btn-primary ms-auto small-margin" id="addTeamMemberBtn">Add Team member</button>
            </div>
            @include('new_team_member_popup')
            @foreach($team->users as $chosenUser)
                <div class="row align-items-center small-margin">
                    @if($chosenUser->profile_picture)
                        <div class="col-auto">
                            <a href="{{ route('openChat', ['userId' => $chosenUser->id]) }}">
                                <img src="data:image/jpeg;base64,{{ base64_encode($chosenUser->profile_picture) }}"
                                     alt="Profile Picture"
                                     class="rounded-circle"
                                     style="width: 45px; height: 45px; object-fit: cover;">
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('openChat', ['userId' => $chosenUser->id]) }}">
                                <p>{{ $chosenUser->name }}</p>
                            </a>
                        </div>
                    @else
                        <div class="col-auto">
                            <a href="{{ route('openChat', ['userId' => $chosenUser->id]) }}">
                                <div class="rounded-circle bg-primary text-white mr-1"
                                     style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                    {{ strtoupper(substr($chosenUser->name, 0, 1)) }}
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('openChat', ['userId' => $chosenUser->id]) }}">
                                <p>{{ $chosenUser->name }}</p>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach



        </div>

    </div>





    <script>
        function updateChosenUser(userId, teamId) {

//cards s  úlohami
            $.ajax({
                type: 'POST',
                url: '/update-chosen-user',
                data: {
                    userId: userId,
                    teamId: teamId
                },
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
                url: '/update-button',
                data: {
                    userId: userId,
                    teamId: teamId
                },
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

    <script>
        $(document).ready(function () {
            $('#addTeamMemberBtn').click(function () {
                $('#ModalCreateNewTeamMember').modal('show');
            });
        });
    </script>

    @include('new_task_popup')
    @include('draggable_script')


@endsection
