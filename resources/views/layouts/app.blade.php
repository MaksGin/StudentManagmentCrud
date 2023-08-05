<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->




                    <!-- Authentication Links -->
                    @guest




                    @else
                    <ul class="navbar-nav me-auto">
                        <a href="{!! URL::to('/') !!}">
                            <img src="/user.png" />
                        </a>
                            <li class="nav-item" style="margin-top: 20px; margin-left: 20px;">
                                @auth
                                    <h4>Witaj, {{ auth()->user()->name }}!</h4>
                                @endauth
                            </li>

                    </ul>
                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ms-auto">
                        <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-secondary bg-gradient rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-secondary); --bs-nav-pills-link-active-bg: var(--bs-white);">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-5" id="profile-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">
                                    <a class="nav-link" href="{{ route('main') }}">Główna</a>
                                </button>
                            </li>
                            @role('Admin')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-5" id="profile-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">
                                    <a class="nav-link" href="{{ route('Students.manage') }}">Manage Students</a>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">
                                    <a class="nav-link" href="{{ route('users.index') }}">Manage Users</a>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">
                                    <a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a>
                                </button>
                            </li>
                            @endrole
                            <li class="nav-item dropdown">
                                <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                                </button>
                            </li>
                        </ul>


                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                        <div class="card-body">
                            @yield('content')
                        </div>

                </div>
            </div>
        </div>
    </main>

</div>
</body>
</html>
