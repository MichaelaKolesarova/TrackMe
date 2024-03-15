@php use App\Models\User; @endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PlanMe</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('icons/audience_8259637.png')}}"/>
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/styles.css'])
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- draggable -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bevacqua/dragula@3.7.3/dist/dragula.min.css">

    <script src="https://cdn.jsdelivr.net/gh/bevacqua/dragula@3.7.3/dist/dragula.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--gannts chart-->
    <script src="https://unpkg.com/timelines-chart"></script>
    <script src="https://d3js.org/d3.v7.min.js"></script>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous"
    />


</head>
<body class="sb-nav-fixed" >

<div id="app" >
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">PlanMe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto">

                </ul>

                <ul class="navbar-nav ms-auto">

                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</div>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion bg-gradient-primary-to-secondary" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    @if(auth()->user()->is_admin)
                        <div class="sb-sidenav-menu-heading">Admin</div>
                        <a class="nav-link " href="/admin-page">
                            <div class="sb-nav-link-icon"><i class="fas fa-hammer"></i></div>
                            Project Administration
                        </a>
                    @endif
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link " href="/home">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Personal Dashboard
                    </a>
                        <div class="sb-sidenav-menu-heading">Teams</div>

                        @foreach(Auth::user()->teams as $team)
                        <a class="nav-link" href="{{ route('home_team', ['teamId' => $team->id]) }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                            {{ $team->team_name }} Dashboard
                        </a>
                        @endforeach

                    <div class="sb-sidenav-menu-heading">Chats</div>
                    <a class="nav-link" href="/openTeamChat">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-comments"></i></div>
                        Team Chat
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseChats"
                       aria-expanded="true" aria-controls="collapseChats">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-comment"></i></div>
                        IndividualChats
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseChats" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">

                            @foreach(User::all() as $user)
                                @if($user->id != auth()->id())
                                    <a class="nav-link" href="{{ route('openChat', ['userId' => $user->id]) }}">{{$user->name}}</a>
                                @endif
                            @endforeach
                        </nav>
                    </div>


                </div>
            </div>
            <a href="{{ route('profile') }}" style="text-decoration: none; color: inherit">
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ auth()->user()->name }}
                </div>
            </a>
        </nav>
    </div>

    <div class="full-width">
        <div id="content">
            <main>
                @yield('content')
            </main>
        </div>
    </div>

</div>

</body>
</body>
</html>
