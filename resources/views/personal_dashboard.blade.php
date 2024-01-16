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
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card tasks-card">
                        <div class="card-body">
                            <div >
                                <span class="card-title-text">TO DO</span>
                                <span class="badge bg-secondary right brown">3 tasks</span>
                            </div>


                            <div  class="task-card">
                                <div class="task-name fill-width row">
                                    <span>khtfktzf</span>
                                    <span>kuzfkuf</span>
                                </div>

                                <div class="dropdown right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>


                                <div class="task-name fill-width row">
                                    <div class="fill-width">
                                        <i class="bi bi-bell-fill left"></i>
                                        <img class="task-assignee-photo right" src="public/images/DSC04686.JPG" alt="photo">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fill-width">
                            <button class="text-button fs-6 fw-bold text-muted" data-toggle="modal" data-target="#taskModal">New Task...</button>
                        </div>


                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card tasks-card">
                        <div class="card-body">
                            <div >
                                <span class="card-title-text">IN PROGRESS</span>
                                <span class="badge bg-secondary right brown">1 task</span>
                            </div>

                            <div class="task-card">
                                <div class="task-name fill-width row">
                                    <span>pripraviť checkpoint</span>
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical right" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                </div>
                                <div class="task-name fill-width row">
                                    <div class="fill-width">
                                        <i class="bi bi-bell-fill left"></i>
                                        <img class="task-assignee-photo right" src="resources/DSC04686.JPG" alt="photo">
                                    </div>
                                </div>
                            </div>
                            <button class="text-button">New Task...</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card tasks-card">
                        <div class="card-body">
                        <div >
                            <span class="card-title-text">DONE</span>
                            <span class="badge bg-secondary right brown">0 tasks</span>
                        </div>

                        <div data-dnd-type="TASK_COLUMN" data-category-id="1415212" data-category-position="2" class="_1IhfQnLQA3Sa0Q8JH6pEiC ui-sortable"></div>
                        <button class="text-button">New Task...</button>
                    </div>
                </div>
            </div>

    </div>

    @include('new_task_popup')

@endsection
