@php
    use App\Models\User;
    use App\Models\Message;

@endphp

@extends('layouts.base')

@section('content')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="container-fluid small-margin">
        <div class="col ">
            <div class="row">
                <h1 class="col fw-bolder small-margin"><span class="text-gradient d-inline ">Team </span></h1>

                <div class="mb-1" id="comments-container">
                    <div id="scrollable" class="scrollable">

                        @foreach(Message::orderBy('created_at')->where('to', 0)->get() as $message)
                            @if($message->from == auth()->id())
                                <div class="be-comment-block">
                                    <div class="be-img-comment-right">
                                        @if($message->authoredBy->profile_picture == null)
                                            <div class="col rounded-circle bg-primary text-white mr-1"
                                                 style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                                {{ strtoupper(substr($message->authoredBy->name, 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="col">
                                                <img src="data:image/jpeg;base64,{{ base64_encode($message->authoredBy->profile_picture) }}"
                                                     class="rounded-circle"
                                                     alt="Profile Picture"
                                                     style="width: 45px; height: 45px; object-fit: cover;">
                                            </div>
                                        @endif
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
                                                       <li><a class="dropdown-item" onclick="setEditingMessage({{$message->id}}, '{{$message->content}}')">Edit</a></li>
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
                                            @if($message->authoredBy->profile_picture == null)
                                                <div class="col rounded-circle bg-primary text-white mr-1"
                                                     style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                                                    {{ strtoupper(substr($message->authoredBy->name, 0, 1)) }}
                                                </div>
                                            @else
                                                <div class="col">
                                                    <img src="data:image/jpeg;base64,{{ base64_encode($message->authoredBy->profile_picture) }}"
                                                         class="rounded-circle"
                                                         alt="Profile Picture"
                                                         style="width: 45px; height: 45px; object-fit: cover;">
                                                </div>
                                            @endif
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

                        <div id="messages" class="messages"></div>

                    </div>



                    <form id="editMessageForm" class="form-block be-comment-block " action="{{ route('editMessage') }}" method="post" style="display: none;">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea id="editMessageContent" class="form-input" name="content" required="" placeholder="Edit your message"></textarea>
                                    <input id="messageIdInput" type="hidden" name="id" value="">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>
                        </div>
                    </form>


                    <form id="createMessageForm" class="form-block be-comment-block" action="{{ route('create.message') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                    <textarea class="form-input" name="content" required="" placeholder="Your text"></textarea>
                                        <input type="hidden" name="to" value="{{0}}">
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

        function setEditingMessage(messageId, messageContent) {
            $('#editMessageContent').val(messageContent);
            $('#messageIdInput').val(messageId);
            $('#createMessageForm').hide();
            $('#editMessageForm').show();
        }
    </script>

    <script>
        const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});
        const channel = pusher.subscribe('public');

        //Receive messages

        channel.bind('chat', function (data) {
            $.post("/receive", {
                _token:  '{{csrf_token()}}',
                id: data.id,
            })
                .then(function (res) {
                    $("#messages").append(res);
                    document.getElementById('scrollable').scrollTop = document.getElementById('scrollable').scrollHeight;
                });
        });



        $("#createMessageForm").submit(function (event) {
            event.preventDefault();

            $.ajax({
                url:     "/create-message",
                method:  'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data:    {
                    _token:  '{{csrf_token()}}',
                    content: $("#createMessageForm textarea[name='content']").val(),
                    to: 0,
                }
            }).done(function (res) {
                $("#messages").append(res);
                $("#createMessageForm textarea[name='content']").val('');
                document.getElementById('scrollable').scrollTop = document.getElementById('scrollable').scrollHeight;

            });

        })


    </script>

@endsection
