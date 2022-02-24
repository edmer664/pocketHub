@auth
<ul class="navbar-nav  sidebar sidebar-dark accordion toggled " id="accordionSidebar" 
style="background-image: url('assets/img/common-bg.svg'); background-size:cover; ">
   <div class="sticky-top">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon ">
            <img class="rounded-circle" src="{{ asset('assets/img/logo2.png')}}" height="40" width="40" alt="">
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

   
    <li class="nav-item">
        <a class="nav-link" href="{{ route('message') }}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Messages</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-block ">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </div>
</ul>
@endauth
