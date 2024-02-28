@php
    use App\Helpers\DataStructures\EntitiesEnum;use App\Helpers\DataStructures\PriorityEnum;
 use App\Helpers\DataStructures\TaskActivitiesEnum;use App\Helpers\DataStructures\TaskStatusEnum;
 use App\Models\Comment;
 use App\Models\Project;use App\Models\Task;
 use App\Models\Log;use App\Models\Team;use App\Models\User;
@endphp
@extends('layouts.base')

@section('content')

    <div class="container-fluid small-margin">
        <div class="col ">
            <div class="row">
                <div class="col d-flex align-items-center" style="padding-right: 50px">
                    <h1 class="fw-bolder small-margin"><span class="text-gradient d-inline">{{$task->title}} </span>
                    </h1>

                    @if(auth()->id() == $task->assignee || auth()->user()->is_admin)
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

                    <h5 class="fs-3 text-muted margin-between-sections">Project: <span class="a_hover">
                        <a class="text-gradient" href="{{ route('project_dashboard', ['project' => $task->project]) }}"
                           style="color: #1a1e21">{{Project::find($task->project)->project_name}}</a>
                    </span></h5>


                    @if($task->parent_task != null)
                        <h5 class="fs-3 text-muted">Parent task:</h5>
                        <p class="margin-between-sections a_hover">
                            <a class="text-decoration-none" href="{{ route('task.overview', ['task' => $task->parent_task]) }}">
                                <span class="text-gradient ">{{$task->parentTask->id}} - {{ $task->parentTask->title }}
                                    @if ($task->parentTask->taskStatus == 1)
                                        <i class="bi bi-hourglass-top"></i>
                                    @elseif ($task->parentTask->taskStatus == 2)
                                        <i class="bi bi-hourglass-split"></i>
                                    @elseif ($task->parentTask->taskStatus == 3)
                                        <i class="bi bi-stop-circle"></i>
                                    @elseif ($task->parentTask->taskStatus == 4)
                                        <i class="bi bi-hourglass-bottom"></i>
                                    @endif

                                    @if ($task->parentTask->priority == 4)
                                        <i class="bi bi-egg-fried"></i>
                                    @elseif ($task->parentTask->priority == 3)
                                        <i class="bi bi-egg-fried"></i>
                                    @elseif ($task->parentTask->priority == 2)
                                        <i class="bi bi-droplet"></i>
                                    @elseif ($task->parentTask->priority == 1)
                                        <i class="bi bi-snow2"></i>
                                    @endif
                                 </span>
                            </a>
                        </p>

                    @else
                        <h5 class="fs-3 text-muted"> Parent task:</h5>
                        <p class="margin-between-sections "><span
                                class="text-gradient">Root task</span></p>
                    @endif

                    @if($task->childTasks()->count() > 0)
                        <h5 class="fs-3 text-muted">Child tasks:</h5>
                        @foreach($task->childTasks as $childtask)
                            <p class="margin-between-sections child-task a_hover">
                                <a class="text-decoration-none " href="{{ route('task.overview', ['task' => $childtask->id]) }}">
                                    <span class="text-gradient">{{$childtask->id}} - {{ $childtask->title }}
                                        <!--TODO - kontrolovať ENUM, nie int -->
                                        @if ($childtask->taskStatus == 1)
                                            <i class="bi bi-hourglass-top"></i>
                                        @elseif ($childtask->taskStatus == 2)
                                            <i class="bi bi-hourglass-split"></i>
                                        @elseif ($childtask->taskStatus == 3)
                                            <i class="bi bi-stop-circle"></i>
                                        @elseif ($childtask->taskStatus == 4)
                                            <i class="bi bi-hourglass-bottom"></i>
                                        @endif

                                        @if ($childtask->priority == 4)
                                            <i class="bi bi-egg-fried"></i>
                                        @elseif ($childtask->priority == 3)
                                            <i class="bi bi-egg-fried"></i>
                                        @elseif ($childtask->priority == 2)
                                            <i class="bi bi-droplet"></i>
                                        @elseif ($childtask->priority == 1)
                                            <i class="bi bi-snow2"></i>
                                        @endif
                                    </span>
                                </a>
                            </p>
                        @endforeach
                    @endif
                    <div class="margin-between-sections"></div>


                    <h5 class="fs-3 text-muted "> Comments:</h5>
                    <div class="mb-1" id="comments-container ">
                        <div>

                        </div>

                        @foreach(Comment::orderBy('created_at')->where('task_id', '=', $task->id)->get() as $comment)
                            <div class="be-comment-block">
                                <div class="be-comment">
                                    <div class="be-img-comment">
                                        <div class="col rounded-circle text-white mr-1"
                                             style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                            @if($comment->authoredBy->profile_picture == null)
                                                <div class="col rounded-circle bg-primary text-white mr-1"
                                                     style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                                    {{ strtoupper(substr($comment->authoredBy->name, 0, 1)) }}
                                                </div>
                                            @else
                                                <div class="col mr-1">
                                                    <img
                                                        src="data:image/jpeg;base64,{{ base64_encode($comment->authoredBy->profile_picture) }}"
                                                        class="rounded-circle"
                                                        alt="Profile Picture"
                                                        style="width: 55px; height: 55px; object-fit: cover;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="be-comment-content">
                                        <div class="flex-grow-1 ml-3 person-text small-margin"></div>
                                        <span><p style="font-size: 25px"> {{$comment->authoredBy->name}} </p></span>
                                        <span class="be-comment-time right">
                                            @if($comment->authoredBy->id == auth()->id())
                                                <div class="dropdown right" style="display: inline-block;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor"
                                                         class="bi bi-three-dots-vertical dropdown-toggle" role="button"
                                                         id="dropdownMenuLink_{{$comment->id}}" data-toggle="dropdown"
                                                         aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    </svg>

                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuLink_{{$comment->id}}">
                                                       <li><a class="dropdown-item"
                                                              onclick="setEditingComment({{$comment->id}}, '{{$comment->content}}')">Edit</a></li>
                                                        <li><a class="dropdown-item"
                                                               href="{{ route('deleteComment', ['id' => $comment->id]) }}">Delete</a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                            <i class="bi bi-clock"></i>{{$comment->created_at}}
                                        </span>

                                        <p class="be-comment-text">
                                            {{$comment->content}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>


                    <form id="editCommentForm" class="form-block be-comment-block " action="{{ route('editComment') }}"
                          method="post" style="display: none;">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea id="editCommentContent" class="form-input" name="content" required=""
                                              placeholder="Edit your message"></textarea>
                                    <input id="commentIdInput" type="hidden" name="id" value="">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>
                        </div>
                    </form>

                    <form id="createCommentForm" class="form-block be-comment-block"
                          action="{{ route('create.comment') }}" method="post">
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

                <div class="col-3 small-margin ml-auto scrollable">

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


                    <p>assignee: </p>
                    <div class="d-flex align-items-start margin-between-sections">
                        <div class="dropdown d-flex align-items-center">
                            <div class="row">
                                <div class="col rounded-circle text-white mr-1"
                                     style="width: 35px; height: 35px; line-height: 35px; text-align: center; font-size: 18px;">
                                    @if ($task->assignedTo)
                                        @if($task->assignedTo->profile_picture == null)
                                            <div class="col rounded-circle bg-primary text-white mr-1"
                                                 style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                                {{ strtoupper(substr($task->assignedTo->name, 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="col">
                                                <img
                                                    src="data:image/jpeg;base64,{{ base64_encode($task->assignedTo->profile_picture) }}"
                                                    class="rounded-circle"
                                                    alt="Profile Picture"
                                                    style="width: 45px; height: 45px; object-fit: cover;">
                                            </div>
                                        @endif
                                    @else
                                        <div class="col rounded-circle bg-primary text-white mr-1"
                                             style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                            U
                                        </div>
                                    @endif
                                </div>
                                <button class="col btn btn-secondary bg-white dropdown-toggle" type="button"
                                        id="assigneeDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" style="margin-left: 25px">

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

                    <p>author: </p>
                    <div class="d-flex align-items-start margin-between-sections">
                        <div class="rounded-circle text-white mr-1"
                             style="width: 35px; height: 35px; line-height: 35px; text-align: center; font-size: 18px;">
                            @if($task->authoredBy->profile_picture == null)
                                <div class="col rounded-circle bg-primary text-white mr-1"
                                     style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                    {{ strtoupper(substr($task->authoredBy->name, 0, 1)) }}
                                </div>
                            @else
                                <div class="col">
                                    <img
                                        src="data:image/jpeg;base64,{{ base64_encode($task->authoredBy->profile_picture) }}"
                                        class="rounded-circle"
                                        alt="Profile Picture"
                                        style="width: 45px; height: 45px; object-fit: cover;">
                                </div>
                            @endif

                        </div>
                        <div class="flex-grow-1 ml-3 person-text small-margin">
                            {{$task->authoredBy->name}}
                        </div>
                    </div>

                    <p>Task Log: </p>
                    <div class="align-items-start margin-between-sections">
                        @foreach(Log::where('entity_id', $task->id)->where('entity_type', EntitiesEnum::Task)->get() as $log)
                            <p>
                                <span class="a_hover">
                                    <a class="text-gradient" href="{{ route('openChat', ['userId' => $log->who]) }}">{{ $log->getWhoName() }}</a>
                                </span>
                                {{ TaskActivitiesEnum::toString(TaskActivitiesEnum::from($log->changedWhat)) }}
                                <span class="text-body-emphasis">
                                    @if($log->changedWhat != null)
                                        @if(TaskActivitiesEnum::from($log->changedWhat) == TaskActivitiesEnum::UpdateAssignee)
                                            @if($log->toWhat != 0)
                                                <span class="a_hover"><a class="text-gradient" href="{{ route('openChat', ['userId' => $log->toWhat]) }}">{{User::find($log->toWhat)->name}}</a></span>
                                            @else
                                                unassigned
                                            @endif
                                        @elseif(TaskActivitiesEnum::from($log->changedWhat) == TaskActivitiesEnum::UpdateDueDate)
                                            {{--User::find($log->toWhat)->name--}}
                                        @elseif(TaskActivitiesEnum::from($log->changedWhat) == TaskActivitiesEnum::UpdatePriority)
                                            {{ PriorityEnum::toString(PriorityEnum::from($log->toWhat)) }}
                                        @elseif(TaskActivitiesEnum::from($log->changedWhat) == TaskActivitiesEnum::UpdateTaskStatus)
                                            {{ TaskStatusEnum::toString(TaskStatusEnum::from($log->toWhat)) }}
                                        @elseif(TaskActivitiesEnum::from($log->changedWhat) == TaskActivitiesEnum::CreateChildTask)
                                             <span class="a_hover">
                                                 <a class="text-gradient" href="{{ route('task.overview', ['task' => $log->toWhat]) }}">{{Task::find($log->toWhat)->id}} - {{ Task::find($log->toWhat)->title }} </a>
                                             </span>
                                        @elseif(TaskActivitiesEnum::from($log->changedWhat) == TaskActivitiesEnum::UpdateTeamAssignedTo)
                                            {{Team::find($log->toWhat)->name}}
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
        document.getElementById('scrollable').scrollTop = document.getElementById('scrollable').scrollHeight;

        function setEditingComment(commentId, commentContent) {
            $('#editCommentContent').val(commentContent);
            $('#commentIdInput').val(commentId);
            $('#createCommentForm').hide();
            $('#editCommentForm').show();
        }
    </script>

@endsection
