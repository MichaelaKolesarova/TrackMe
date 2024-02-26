

@php
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Models\Task;use App\Models\User;
@endphp

    <div id="tasks_container" class="col fill-width small-margin">
        <div class="row justify-content-around">
            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                <div class="card tasks-card">
                    <div class="card-body">
                        <div>
                            <span class="card-title-text">TO DO</span>
                            <span class="badge bg-secondary right brown">{{App\Models\Task::all()->where('assignee', $chosenUser)->where('taskStatus', App\Helpers\DataStructures\TaskStatusEnum::ToDo->value)->count() }} tasks</span>
                        </div>

                        <div taskStatus="{{TaskStatusEnum::ToDo}}" id="card-tasks-todo" class="min-height">

                            @foreach(Task::all()->where('assignee', $chosenUser)->where('taskStatus', App\Helpers\DataStructures\TaskStatusEnum::ToDo->value) as $task)
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
                                                     class="bi bi-three-dots-vertical dropdown-toggle" role="button"
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
                                class="badge bg-secondary right brown">{{Task::all()->where('assignee', $chosenUser)->where('taskStatus',  TaskStatusEnum::InProgress->value)->count()}} tasks</span>
                        </div>

                        <div taskStatus="{{TaskStatusEnum::InProgress}}" id="card-tasks-inprogres" class="min-height">

                            @foreach(Task::all()->where('assignee', $chosenUser)->where('taskStatus', TaskStatusEnum::InProgress->value) as $task)
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
                                                     class="bi bi-three-dots-vertical dropdown-toggle" role="button"
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
                                class="badge bg-secondary right brown">{{Task::all()->where('assignee', $chosenUser)->where('taskStatus', TaskStatusEnum::Blocked->value)->count()}} tasks</span>
                        </div>

                        <div taskStatus="{{TaskStatusEnum::Blocked}}" id="card-tasks-blocked" class="min-height">

                            @foreach(Task::all()->where('assignee', $chosenUser)->where('taskStatus', TaskStatusEnum::Blocked->value) as $task)
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
                                                     class="bi bi-three-dots-vertical dropdown-toggle" role="button"
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
                                class="badge bg-secondary right brown">{{Task::all()->where('assignee', $chosenUser)->where('taskStatus', TaskStatusEnum::Done->value)->count()}} tasks</span>
                        </div>

                        <div taskStatus="{{TaskStatusEnum::Done}}" id="card-tasks-done" class="min-height">
                            @foreach(Task::all()->where('assignee', $chosenUser)->where('taskStatus', TaskStatusEnum::Done->value) as $task)
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
                                                     class="bi bi-three-dots-vertical dropdown-toggle" role="button"
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

