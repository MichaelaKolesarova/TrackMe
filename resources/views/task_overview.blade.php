@php use App\Helpers\DataStructures\TaskStatusEnum; @endphp
@extends('layouts.base')

@section('content')

    <div class="container-fluid small-margin">
        <div class="col">
            <div class="row">
                <h1 class="col fw-bolder small-margin"><span
                        class="text-gradient d-inline ">{{$task->title}}</span></h1>

                <h5 class="small-margin fs-3 text-muted"> ID: <span style="color: #1a1e21">{{$task->id}} </span></h5>

                <div class="col small-margin">

                    <!--
                    <div class="btn-group almost-full-width-buttons margin-between-sections" role="group" aria-label="Basic outlined example">
                        <button type="button" class="btn btn-outline-dark">Attachement</button>
                        <button type="button" class="btn btn-outline-dark">Create linked subtask</button>
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Link Issue</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">to existing issue</a></li>
                            <li><a class="dropdown-item" href="#">to new issue</a></li>
                        </ul>
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Copy Issue</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">as new issue</a></li>
                            <li><a class="dropdown-item" href="#">as update of old issue</a></li>
                        </ul>
                        <button type="button" class="btn btn-outline-dark">...</button>
                    </div>
                    -->


                    <h5 class="fs-3 text-muted"> Description:</h5>
                    <p class="margin-between-sections "><span style="color: #1a1e21">{{$task->description}}</span></p>


                    <h5 class="fs-3 text-muted"> Attachements:</h5>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="formFile">
                    </div>

                    <h5 class="fs-3 text-muted"> Comments:</h5>
                    <div class="mb-3">

                    </div>


                </div>

                <div class="col-3 small-margin ml-auto">
                    <p>status: </p>
                    <div class="btn-group margin-between-sections">
                        <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Task Status
                        </button>
                        <div class="dropdown-menu">
                            @foreach(TaskStatusEnum::cases() as $status)
                                <a class="dropdown-item" href="#">{{$status}}</a>
                            @endforeach
                        </div>
                    </div>

                    <p>Assignee: </p>
                    <div class="d-flex align-items-start margin-between-sections">
                        <img src="resources/DSC04686.JPG" class="rounded-circle mr-1" alt="William Harris" width="35"
                             height="35">
                        <div class="flex-grow-1 ml-3 person-text">
                            Michaela Kolesárová
                        </div>
                    </div>

                    <p>Reporter: </p>
                    <div class="d-flex align-items-start margin-between-sections">
                        <img src="resources/DSC04686.JPG" class="rounded-circle mr-1" alt="William Harris" width="35"
                             height="35">
                        <div class="flex-grow-1 ml-3 person-text">
                            Michaela Kolesárová
                        </div>
                    </div>

                    <p>Labels: </p>
                    <div class="d-flex align-items-start margin-between-sections">
                        <i class="bi bi-tags"></i>
                        <div class="flex-grow-1 ml-3 person-text small-margin">
                            urgent
                        </div>
                        <i class="bi bi-tags"></i>
                        <div class="flex-grow-1 ml-3 person-text small-margin">
                            admin
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
