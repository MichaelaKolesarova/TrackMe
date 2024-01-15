@extends('layouts.overview')
@section('content')

    <body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">


        <header class="py-5">
            <div class="container px-5 pb-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-xxl-5">

                        <div class="text-center text-xxl-start">
                            <div class="badge bg-gradient-primary-to-secondary text-white mb-4">
                                <div class="text-uppercase">plan &middot; execute &middot; celebrate</div>
                            </div>
                            <div class="fs-3 fw-light text-muted">we can help your business to have every support
                                software needed
                            </div>
                            <h1 class="display-3 fw-bolder mb-5"><span
                                    class="text-gradient d-inline">in  one place</span></h1>
                            <div
                                class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                                @guest
                                    @if (Route::has('login'))
                                        <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder"
                                           href="{{ route('login')}}">{{ __('Login')}}</a>
                                    @endif

                                    @if(Route::has('register'))
                                        <a class="btn btn-outline-dark btn-lg px-5 py-3 fs-6 fw-bolder"
                                           href="{{ route('register')}}">{{ __('Register')}}</a>
                                    @endif
                                @else
                                    <a class="btn btn-outline-dark btn-lg px-5 py-3 fs-6 fw-bolder"
                                       href="{{ route('register') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endguest
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-7">

                        <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                            <div class="profile ">

                                <div class="text-center">
                                    <img src="{{asset('icons/audience_8259637.png')}}" alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </header>
        <!-- About Section-->
        <section class="bg-light py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xxl-8">
                        <div class="text-center my-5">
                            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">About Us</span></h2>
                            <p class="lead fw-light mb-4">Us, better to say, Me, are making this project managemenet app
                                as a term assigment within the class VAII on FRI-UNIZA </p>
                            <p class="text-muted">In case of some problems, ask me, <a
                                    href="mailto: kolesar.michaela.com">e-mail me</a>, or use following social media</p>
                            <div class="d-flex justify-content-center fs-2 gap-4">
                                <a class="text-gradient"
                                   href="https://www.linkedin.com/in/michaela-koles%C3%A1rov%C3%A1-61362b230/"
                                   target="_blank"><i class="bi bi-linkedin"></i></a>
                                <a class="text-gradient" href="https://github.com/MichaelaKolesarova" target="_blank"><i
                                        class="bi bi-github"></i></a>
                                <a class="text-gradient" href="https://gitlab.com/kolesar.michaela" target="_blank"><i
                                        class="bi bi-git"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer-->
    <footer class="bg-white py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0">Copyright &copy; VAII-FRI-UNIZA 2023-2024</div>
                </div>
                <div class="col-auto">
                    <a class="small" href="#!">Terms</a> <!-- TODO -->
                    <span class="mx-1">&middot;</span>
                    <a class="small" href="#!">Contact</a> <!-- TODO -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>


    </body>

@endsection
