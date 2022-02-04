@auth
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'PocketHub') }}</div>
    </a>
    <hr class="sidebar-divider my-0">
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw  fa-home"></i>
            <span>Home</span></a>
    </li>

    <!-- TODO-->
    <!-- <li class="nav-item">
        <a class="nav-link" href="messages.html">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Messages</span></a>
    </li> -->
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
@endauth
