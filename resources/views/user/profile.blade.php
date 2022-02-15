@extends('layouts.app')

@section('content')

<div class="card mb-3 w-100">
    <div class="row no-gutters">
        <div class="col-lg-2">
            @if (Auth::user()->avatar_path == null)
            <img class="rounded-circle  mx-4 my-2" width="150" height="150"
                src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                alt="">
            @else
            <img src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" class="rounded-circle  m-3 " alt="..."
                width="150" height="150">
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                <p class="card-text">{{ Auth::user()->email }}</p>
                <p class="card-text"><small class="text-muted">Joined {{ Auth::user()->created_at }}</small></p>
                <a type="button" class="btn btn-primary btn-sm mb-3" href="{{ route('editInfo') }}">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
<div class="card border-left-primary shadow">
    <div class="row  ">
        <div class="col-auto py-3 d-none d-sm-inline-block pl-4">
            @if (Auth::user()->avatar_path == null)
            <img class="rounded-circle " width="60" height="60"
                src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                alt="">
            @else
            <img class="rounded-circle " width="60" height="60"
                src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
            @endif
        </div>
        <div class="col ">
            <form action="{{ route('createPost') }}" method="POST">
                {{ csrf_field() }}
                <div class="row py-2 mx-3">
                    <div class="input-group">
                        <textarea class="form-control custom-control " placeholder="What's in your Mind?"
                        name='content' rows="3" style="resize:none"></textarea>
                    </div>
                </div>
                <div class="row justify-content-end mx-3">
                    <button type="submit" class="input-group-addon btn btn-primary mb-2">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<h4 class="my-3">Posts</h4>
@foreach ($posts as $post)
<div class="card my-3 ">
    <div class="row">
        <div class="col-auto pt-1">
            @if (Auth::user()->avatar_path == null)
            <img class="rounded-circle  m-3" width="50" height="50"
                src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                alt="">
            @else
            <img class="rounded-circle m-3 " width="50" height="50"
                src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
            @endif
        </div>
        <div class="col pt-3">
            <h5 class="card-title font-weight-bolder">Jane Doe </h5>
        </div>
        <div class="col text-right p-3">
            <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button">Edit</button>
                <form action="{{ route('deletePost', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                   <button class="dropdown-item" type="submit">Delete</button>
                </form>
                
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col container pl-5 pt-3">
            <p class="card-text">{{$post->content}}</p>
        </div>
    </div>
    <div class="row justify-content-end py-3 mr-4 ">
        <small> {{ $post->created_at->diffForHumans() }}</small>
    </div>
    <div class="row justify-content-end pb-2 mr-4 ">
        <a href="{{ route('showPost', ['id' => $post->id]) }}" class="pt-2 px-2 link-dark">
            @if($post->comments_count == 0)
                No comment
            @else
                {{ $post->comments_count }} comments
            @endif
        </a>
        <a type="button" class="btn btn-primary btn-sm mb-3"href="{{ route('showPost', ['id' => $post->id]) }}"><i
                class="fa-solid fa-comment p-1 "></i>Add Comment</a>
    </div>
</div>
@endforeach
@endsection
