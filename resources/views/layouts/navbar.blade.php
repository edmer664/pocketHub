<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow sticky-top">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <div class="topbar-divider d-none d-sm-block"></div>
    @auth
    <h4>Home</h4>
    @endauth
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small name">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </span>
                @if (Auth::user()->avatar_path == null)
                <img class="image-profile rounded-circle default-avatar" width="40" height="40"
                    src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                    alt="">
                @else
                <img class="image-profile rounded-circle  avatar-hide " width="40" height="40"
                    src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
                @endif
                <img class="image-profile rounded-circle  avatar d-none" width="40" height="40"
                    src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">

            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
