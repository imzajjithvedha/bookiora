<div class="container-fluid navbar-fluid">
    <i class="bi bi-text-paragraph collapse-icon"></i>

    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('storage/global/logo.png') }}" alt="Logo" class="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-text-paragraph icon"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav align-items-center ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'stays' ? 'active' : '' }}" href="{{ route('stays.index') }}">Stays</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'surf-camps' ? 'active' : '' }}" href="{{ route('surf-camps.index') }}">Surf Camps</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'contact-us' ? 'active' : '' }}" href="{{ route('contact-us.index') }}">Contact Us</a>
                    </li>

                    @auth()
                        <!-- In future -->
                        <li class="nav-item dropdown">
                            <div class="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(auth()->user()->image)
                                    <img src="{{ asset('storage/backend/users/' . auth()->user()->image) }}" alt="Image" class="profile-image">
                                @else
                                    <img src="{{ asset('storage/global/no-profile-image.png') }}" alt="Image" class="profile-image">
                                @endif

                                <p class="name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                            </div>

                            <ul class="dropdown-menu profile-dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route(auth()->user()->role . '.dashboard') }}"><i class="bi bi-person"></i>Dashboard</a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="log-out"><i class="bi bi-power"></i>Logout</button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- In future -->
                    @else
                        <li class="nav-item">
                            <a class="nav-link login-button" href="{{ route('login') }}">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link register-button" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</div>