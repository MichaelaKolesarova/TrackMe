@php
    use App\Models\User;
    use App\Models\Message;



@endphp

@extends('layouts.base')

@section('content')

    <div class="container-fluid small-margin">
        <div class="col ">
            <div class="row">
                <h1 class="col fw-bolder small-margin"><span class="text-gradient d-inline ">{{$user->name}}</span></h1>

                <div class="mb-1" id="comments-container">


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
                                        <span class="be-comment-time be-comment-time-left"><i class="bi bi-clock"></i>{{$message->created_at}}</span>
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


                    <form class="form-block be-comment-block fixed-bottom" action="{{ route('create.message') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                    <textarea class="form-input" name="content" required=""
                                              placeholder="Your text"></textarea>
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

@endsection
