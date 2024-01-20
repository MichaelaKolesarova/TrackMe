@php use App\Helpers\DataStructures\TaskStatusEnum;use App\Models\Comment;use App\Models\User; @endphp
@extends('layouts.base')

@section('content')

    <div class="container-fluid small-margin">
        <div class="col ">
            <div class="row">
                <h1 class="col fw-bolder small-margin"><span
                        class="text-gradient d-inline ">{{$user->name}}</span></h1>

                <h5 class="small-margin fs-3 text-muted"> ID: <span style="color: #1a1e21">{{$user->name}} </span></h5>


            </div>
        </div>
    </div>

@endsection
