@php use App\Helpers\DataStructures\PriorityEnum;use App\Helpers\DataStructures\TaskStatusEnum;use App\Models\Comment;use App\Models\User; @endphp
@extends('layouts.base')

@section('content')

    <div class="container-fluid small-margin">
        <div class="col ">
            <div class="row">
                <div class="col d-flex align-items-center" style="padding-right: 50px">
                    <h1 class="fw-bolder small-margin"><span class="text-gradient d-inline">{{$task->title}}</span></h1>

                    @if(auth()->id() == $task->assignee || auth()->user()->is_team_lead)
                        <form action="{{ route('deleteTask', ['id' => $task->id]) }}" method="get" class=" ms-auto">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    @endif


                </div>


                <h5 class="small-margin fs-3 text-muted"> ID: <span style="color: #1a1e21">{{$task->id}} </span></h5>

                <div class="col small-margin scrollable">

                    <h5 class="fs-3 text-muted"> Description:</h5>
                    <p class="margin-between-sections "><span style="color: #1a1e21">{{$task->description}}</span></p>


                    <h5 class="fs-3 text-muted"> Comments:</h5>
                    <div class="mb-1" id="comments-container ">
                        <div>

                        </div>

                        @foreach(Comment::orderBy('created_at')->where('task_id', '=', $task->id)->get() as $comment)
                            <div class="be-comment-block">
                                <div class="be-comment">
                                    <div class="be-img-comment">
                                        <div class="col rounded-circle bg-primary text-white mr-1"
                                             style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                            {{ strtoupper(substr($comment->authoredBy->name, 0, 1)) }}
                                        </div>
                                    </div>

                                    <div class="be-comment-content">
                                        <div class="flex-grow-1 ml-3 person-text small-margin"></div>
                                        <span><p style="font-size: 25px"> {{$comment->authoredBy->name}} </p></span>
                                        <span class="be-comment-time"><i class="bi bi-clock"></i>{{$comment->created_at}}</span>

                                        <p class="be-comment-text">
                                            {{$comment->content}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>


                    <form class="form-block be-comment-block" action="{{ route('create.comment') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea class="form-input" name="content" required=""
                                              placeholder="Your text"></textarea>
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-3 small-margin ml-auto">

                    <p>status: </p>

                    <div class="dropdown margin-between-sections">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            {{ TaskStatusEnum::toString(TaskStatusEnum::from($task->taskStatus)) }}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach(TaskStatusEnum::cases() as $status)
                                @if($status != TaskStatusEnum::from($task->taskStatus))
                                    <li>
                                        <form id="updateStatusForm-{{ $status }}" method="post"
                                              action="{{ route('updateOnlyStatus') }}">
                                            @csrf
                                            <input type="hidden" name="taskId" value="{{ $task->id }}">
                                            <input type="hidden" name="newStatus" value="{{ $status }}">
                                            <a class="dropdown-item" href="#"
                                               onclick="document.getElementById('updateStatusForm-{{ $status }}').submit(); return false;">
                                                {{ TaskStatusEnum::toString($status) }}
                                            </a>
                                        </form>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <p>priority: </p>

                    <div class="dropdown margin-between-sections">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            {{ PriorityEnum::toString(PriorityEnum::from($task->priority)) }}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach(PriorityEnum::cases() as $status)
                                @if($status != PriorityEnum::from($task->priority))
                                    <li>
                                        <form id="updatePriorityForm-{{ $status }}" method="post"
                                              action="{{ route('updateOnlyPriority') }}">
                                            @csrf
                                            <input type="hidden" name="taskId" value="{{ $task->id }}">
                                            <input type="hidden" name="newStatus" value="{{ $status }}">
                                            <a class="dropdown-item" href="#"
                                               onclick="document.getElementById('updatePriorityForm-{{ $status }}').submit(); return false;">
                                                {{ PriorityEnum::toString($status) }}
                                            </a>
                                        </form>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>


                    <p>Assignee: </p>
                    <div class="d-flex align-items-start margin-between-sections">
                        <div class="dropdown">
                            <div class="row">
                                <div class="col rounded-circle bg-primary text-white mr-1"
                                     style="width: 35px; height: 35px; line-height: 35px; text-align: center; font-size: 18px;">
                                    @if ($task->assignedTo)
                                        {{ strtoupper(substr($task->assignedTo->name, 0, 1)) }}
                                    @else
                                        U
                                    @endif
                                </div>
                                <button class="col btn btn-secondary bg-white dropdown-toggle" type="button"
                                        id="assigneeDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" style="margin-left: 10px">

                                    @if ($task->assignedTo)
                                        {{ $task->assignedTo->name}}
                                    @else
                                        unassigned
                                    @endif
                                </button>
                                <div class="col dropdown-menu dropdown-menu-end text-white"
                                     aria-labelledby="assigneeDropdown">
                                    <li>
                                        <form id="updateForm-0" method="post"
                                              action="{{ route('updateOnlyAssignee') }}">
                                            @csrf
                                            <input type="hidden" name="taskId" value="{{ $task->id }}">
                                            <input type="hidden" name="newAssignee" value="0">
                                            <a class="dropdown-item" href="#"
                                               onclick="document.getElementById('updateForm-0').submit(); return false;">
                                                unassigned
                                            </a>
                                        </form>
                                    </li>
                                    @foreach(User::all() as $user)
                                        @if($user->id != $task->assignee)
                                            <li>
                                                <form id="updateForm-{{ $user->id }}" method="post"
                                                      action="{{ route('updateOnlyAssignee') }}">
                                                    @csrf
                                                    <input type="hidden" name="taskId" value="{{ $task->id }}">
                                                    <input type="hidden" name="newAssignee" value="{{ $user->id }}">
                                                    <a class="dropdown-item" href="#"
                                                       onclick="document.getElementById('updateForm-{{ $user->id }}').submit(); return false;">
                                                        {{ $user->name }}
                                                    </a>
                                                </form>
                                            </li>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>

                    <p>Author: </p>
                    <div class="d-flex align-items-start margin-between-sections">
                        <div class="rounded-circle bg-primary text-white mr-1"
                             style="width: 35px; height: 35px; line-height: 35px; text-align: center; font-size: 18px;">
                            {{ strtoupper(substr($task->authoredBy->name, 0, 1)) }}
                        </div>
                        <div class="flex-grow-1 ml-3 person-text small-margin">
                            {{$task->authoredBy->name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
