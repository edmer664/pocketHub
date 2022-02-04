@extends('layouts.app')

@section('content')
<div class="card mb-3 w-100">
    <div class="row no-gutters">
        <div class="col-md-2">
            <img src="assets/img/undraw_profile.svg" class="w-100 m-3 " alt="...">
        </div>
        <div class="col-md-9 ml-3 mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                <p class="card-text">{{ Auth::user()->email }}</p>
                <p class="card-text"><small class="text-muted">Joined {{ Auth::user()->created_at }}</small></p>
                <button class="btn btn-primary p-1"><a class="nav-link text-white" href="{{ route('edit') }}">
                        <span>Edit profile</span></a></button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="w-100">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body w-100">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto mr-2">
                        <img class="rounded-circle img-fluid" width="60" src="assets/img/undraw_profile.svg" alt="">
                    </div>
                    <div class="col ">
                        <form action="">
                            <div class="input-group">
                                <textarea class="form-control custom-control" placeholder="What's in your Mind?"
                                    rows="3" style="resize:none"></textarea>
                                <button class="input-group-addon btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 mt-3">
        <div class="card shadow mb-4">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-auto  p-3">
                        <img class="rounded-circle img-fluid" width="60" src="img/1240254.jpg" alt="">
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as
                                a natural lead-in to additional content. This content is a little
                                bit longer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
