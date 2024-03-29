<div class="be-comment-block message">
    <div class="be-img-comment-right">

        @if($message->authoredBy->profile_picture == null)
            <div class="col rounded-circle bg-primary text-white mr-1"
                 style="width: 45px; height: 45px; line-height: 45px; text-align: center; font-size: 30px;">
                {{ strtoupper(substr($message->authoredBy->name, 0, 1)) }}
            </div>
        @else
            <div class="col">
                <img src="data:image/jpeg;base64,{{ base64_encode($message->authoredBy->profile_picture) }}"
                     class="rounded-circle" alt="Profile Picture" style="width: 45px; height: 45px; object-fit: cover;">
            </div>
        @endif


    </div>
    <div class="be-comment">
        <div class="be-comment-content-right">

                <span class="be-comment-time be-comment-time-left">
                    <i class="bi bi-clock"></i>{{$message->created_at}}
                    <div class="dropdown right" style="display: inline-block;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-three-dots-vertical dropdown-toggle" role="button"
                             id="dropdownMenuLink_$message->id}}" data-toggle="dropdown" aria-haspopup="true"
                             aria-expanded="false" viewBox="0 0 16 16"><path
                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/></svg>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink_$message->id">
                            <li><a class="dropdown-item"
                                   onclick="setEditingMessage({{$message->id}}, '$message->content')">Edit</a></li>
                            <li><a class="dropdown-item" href=" {{ route('deleteMessage', ['id' => $message->id])}} ">Delete</a></li>
                        </ul>
                    </div>

                </span>

            <span><p style="font-size: 15px; margin-bottom: 5px; text-align: right"> {{$message->authoredBy->name}} </p></span>

            <p class="be-comment-text" style="font-size: 20px;">
                {{$message->content}}
            </p>
        </div>

    </div>
</div>
