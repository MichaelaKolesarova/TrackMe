@php
    use App\Helpers\DataStructures\TaskStatusEnum;
    use App\Models\User;
@endphp

@extends('layouts.base')

@section('content')
    <div class="row small-margin">
        <h1 class="col display-3 fw-bolder"><span
                class="text-gradient d-inline">personal dashboard</span></h1>

        <a class="col col-lg-3 btn btn-primary fw-bolder small-margin d-flex align-items-center justify-content-center"
           data-bs-toggle="modal" data-bs-target="#ModalCreate">New Task</a>
    </div>
    <div style="margin: 50px"></div>

    <div id="tasks_container" class="col fill-width small-margin">
        <div class="row justify-content-around">
            <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                <div class="card tasks-card">
                    <div class="card-body">
                        <div>
                            <span class="card-title-text">TO DO</span>
                            <span class="badge bg-secondary right brown">{{auth()->user()->usersTasks(TaskStatusEnum::ToDo)->count()}} tasks</span>
                        </div>

                        <div taskStatus="{{TaskStatusEnum::ToDo}}" id="card-tasks-todo">

                            @foreach(auth()->user()->usersTasks(TaskStatusEnum::ToDo) as $task)
                                <div id="{{$task->id}}" class="task-card" draggable="true">
                                    <div class="task-name fill-width row">
                                        <span>{{$task->title}}</span>

                                        <div class="dropdown right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-three-dots-vertical dropdown-toggle" role="button"
                                                 id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                            </ul>
                                        </div>
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
                                class="badge bg-secondary right brown">{{auth()->user()->usersTasks(TaskStatusEnum::InProgress)->count()}} tasks</span>
                        </div>

                        <div taskStatus="{{TaskStatusEnum::InProgress}}" id="card-tasks-inprogres">

                            @foreach(auth()->user()->usersTasks(TaskStatusEnum::InProgress) as $task)
                                <div id="{{$task->id}}" class="task-card" draggable="true">
                                    <div class="task-name fill-width row">
                                        <span>{{$task->title}}</span>

                                        <div class="dropdown right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-three-dots-vertical dropdown-toggle" role="button"
                                                 id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                            </ul>
                                        </div>
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
                                class="badge bg-secondary right brown">{{auth()->user()->usersTasks(TaskStatusEnum::Blocked)->count()}} tasks</span>
                        </div>

                        <div taskStatus="{{TaskStatusEnum::Blocked}}" id="card-tasks-blocked">
                            @foreach(auth()->user()->usersTasks(TaskStatusEnum::Blocked) as $task)
                                <div id="{{$task->id}}"  class="task-card" draggable="true">
                                    <div class="task-name fill-width row">
                                        <span>{{$task->title}}</span>

                                        <div class="dropdown right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-three-dots-vertical dropdown-toggle" role="button"
                                                 id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                            </ul>
                                        </div>
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
                                class="badge bg-secondary right brown">{{auth()->user()->usersTasks(TaskStatusEnum::Done)->count()}} tasks</span>
                        </div>

                        <div taskStatus="{{TaskStatusEnum::Done}}" id="card-tasks-done" class="small-margin">
                            @foreach(auth()->user()->usersTasks(TaskStatusEnum::Done) as $task)
                                <div id="{{$task->id}}" class="task-card" draggable="true">
                                    <div class="task-name fill-width row">
                                        <span>{{$task->title}}</span>

                                        <div class="dropdown right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-three-dots-vertical dropdown-toggle" role="button"
                                                 id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

    @include('new_task_popup')
    @include('draggable_script')

@endsection
