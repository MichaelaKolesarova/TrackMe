@php
    use App\Models\User;
    use App\Models\Message;



@endphp

@extends('layouts.base')

@section('content')
    @php
        $editingMessage = false;
    @endphp


    <div class="container-fluid small-margin">
        <div class="col ">
            <div class="row">
                <h1 class="col fw-bolder small-margin"><span class="text-gradient d-inline ">{{$user->name}}</span></h1>

                <div class="mb-1" id="comments-container">
                    <div id="scrollable" class="scrollable">

                        @foreach(Message::orderBy('created_at')
                           ->where(function ($query) use ($user) {
                               $query->where('from', auth()->id())->where('to', $user->id);
                           })
                           ->orWhere(function ($query) use ($user) {
                               $query->where('from', $user->id)->where('to', auth()->id());
                           })
                           ->get() as $message)
                            @if($message->from == auth()->id())
                                <div class="be-comment-block">
                                    <div class="be-img-comment-right">
                                        <div class="col rounded-circle bg-primary text-white mr-1"
                                             style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                            {{ strtoupper(substr($message->authoredBy->name, 0, 1)) }}
                                        </div>
                                    </div>


                                    <div class="be-comment">
                                        <div class="be-comment-content-right">
                                            <span class="be-comment-time be-comment-time-left">
                                                <i class="bi bi-clock"></i>{{$message->created_at}}
                                                <div class="dropdown right" style="display: inline-block;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" role="button" id="dropdownMenuLink_{{$message->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                    </svg>

                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink_{{$message->id}}">
                                                       <li><a class="dropdown-item" onclick="setEditingMessage()">Edit</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('deleteMessage', ['id' => $message->id]) }}">Delete</a></li>
                                                    </ul>
                                                </div>

                                            </span>
                                            <span ><p style="font-size: 15px; margin-bottom: 5px; text-align: right"> {{$message->authoredBy->name}} </p></span>


                                            <p class="be-comment-text" style="font-size: 20px;">
                                                {{$message->content}}
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            @else

                                <div class="be-comment-block">
                                    <div class="be-comment">
                                        <div class="be-img-comment">
                                            <div class="col rounded-circle bg-primary text-white "
                                                 style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                                {{ strtoupper(substr($message->authoredBy->name, 0, 1)) }}
                                            </div>
                                        </div>

                                        <div class="be-comment-content">
                                            <span><p style="font-size: 15px; margin-bottom: 5px;"> {{$message->authoredBy->name}} </p></span>
                                            <span class="be-comment-time be-comment-time-right"><i class="bi bi-clock"></i>{{$message->created_at}}</span>

                                            <p class="be-comment-text" style="font-size: 20px;">
                                                {{$message->content}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <form id="editMessageForm" class="form-block be-comment-block " action="{{ route('editMessage', ['id' => $message->id]) }}" method="post" style="display: none;">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea class="form-input" name="content" required="" placeholder="Edit your message">{{ $message->content }}</textarea>
                                    <input type="hidden" name="to" value="{{ $message->to }}">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>
                        </div>
                    </form>

                    <form id="createMessageForm" class="form-block be-comment-block " action="{{ route('create.message') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea class="form-input" name="content" required="" placeholder="Your text"></textarea>
                                    <input type="hidden" name="to" value="{{ $user->id }}">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>

    <script>
        document.getElementById('scrollable').scrollTop = document.getElementById('scrollable').scrollHeight;
    </script>
    <script>
        function setEditingMessage(messageId) {
            $('#createMessageForm').hide();
            $('#editMessageForm').show();
        }
    </script>


@endsection
