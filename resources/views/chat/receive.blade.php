@php
    $message = \App\Models\Message::find($id);
@endphp
<div class="be-comment-block message">
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
                {{\App\Models\Message::find($id)->content}}
            </p>
        </div>
    </div>
</div>
