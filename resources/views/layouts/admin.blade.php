<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boolbnb</title>

    {{-- VITE --}}
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="wrapper-admin">
        {{-- Header --}}
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                        <div class="logo_laravel">
                            <img src="{{ asset('/storage/icons_svg/logo-lg.svg') }}" class="d-none d-lg-block"
                                alt="">
                            <img src="{{ asset('/storage/icons_svg/logo-sm.svg') }}" alt="" class="d-lg-none">
                        </div>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa-solid fa-user"></i>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container-fluid">
            <div class="row flex-nowrap">
                {{-- Sidebar --}}
                <div class="sidebar col col-md-2 d-md-block">
                    <div class="sidebar__container container">
                        <ul>
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="sidebar__link {{ Route::currentRouteName() === 'admin.dashboard' ? 'cl-primary' : '' }}">
                                    <i class="fa-solid fa-house-user icon"></i>
                                    <span class="d-none d-lg-block">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.apartments.index') }}"
                                    class="sidebar__link {{ Route::currentRouteName() === 'admin.apartments.index' ? 'cl-primary' : '' }} {{ Auth::user()->apartments->count() == 0 ? 'd-none' : '' }}">
                                    <i class="fa-solid fa-list icon"></i>
                                    <span class="d-none d-lg-block">Apartments</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.apartments.create') }}"
                                    class="sidebar__link {{ Route::currentRouteName() === 'admin.apartments.create' ? 'cl-primary' : '' }}">
                                    <i class="fa-solid fa-plus icon"></i>
                                    <span class="d-none d-lg-block">Create new apartment</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.report') }}"
                                    class="sidebar__link {{ Auth::user()->apartments->count() == 0 ? 'd-none' : '' }} {{ Route::currentRouteName() === 'admin.report' ? 'cl-primary' : '' }}"">
                                    <i class="fa-solid fa-chart-simple icon"></i>
                                    <span class="d-none d-lg-block">Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- Content --}}
                <main class="content col-10 col-md-10 overflow-auto">
                    @yield('content')
                </main>
            </div>
        </div>
        <footer class="d-flex justify-content-between align-items-center container-fluid">
            <div>
                <h6 class="fw-bolder m-0">Copyright 2023 Boolbnb, Inc | All Rights Reserved</h6>
            </div>
            <ul class="socials-icons d-flex justify-content-between m-0">
                <li class="me-3">
                    <i class="fa-brands fa-facebook-f"></i>
                </li>
                <li class="me-3">
                    <i class="fa-brands fa-twitter"></i>
                </li>
                <li class="me-3">
                    <i class="fa-brands fa-youtube"></i>
                </li>
                <li class="me-3">
                    <i class="fa-brands fa-instagram"></i>
                </li>
                <li>
                    <i class="fa-brands fa-linkedin"></i>
                </li>
            </ul>
        </footer>
    </div>
</body>

</html>
