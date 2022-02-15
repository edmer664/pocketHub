@extends('layouts.app')

@section('content')
<div class="card border-left-primary shadow pt-3">
    <div class="row  ">
        <div class="col-auto py-3 d-none d-sm-inline-block pl-4">
            @if (Auth::user()->avatar_path == null)
            <img class="rounded-circle " width="80" height="80"
                src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                alt="">
            @else
            <img class="rounded-circle" width="80" height="80"
                src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
            @endif
        </div>
        <div class="col">
            <form action="{{ route('createPost') }}" method="POST">
                {{ csrf_field() }}
                <div class="row py-2 mr-3 ml-2">
                    <div class="input-group">
                        <textarea class="form-control custom-control "
                            placeholder="What's in your mind, {{ Auth::user()->first_name }}? " name='content' rows="3"
                            style="resize:none"></textarea>
                    </div>
                </div>
                <div class="row justify-content-end mx-3">
                    <button type="submit" class="input-group-addon btn btn-primary mb-2">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
<h3 class="my-3" style="color:#4267d6">Posts</h3>
@foreach ($posts as $post)
<div class="card my-5 ">
    <div class="row">
        <div class="col-auto py-3 px-4">
            @if ($post->author_avatar == null)
            <img class="rounded-circle" width="60" height="60"
                src="https://avatars.dicebear.com/api/initials/{{substr($post->first_name, 0, 1) . substr($post->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                alt="">
            @else
            <img class="rounded-circle " width="60" height="60"
                src="{{ url('storage/avatars/' . $post->author_avatar) }}" alt="">
            @endif

        </div>
        <div class="col pt-4">
            <h5 class="card-title font-weight-bolder">{{ $post->first_name . " " . $post->last_name }} </h5>
        </div>
        <div class="col text-right p-3">
            @if(Auth::user()->id == $post->user->id)

                <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">

                    <button onclick="editPost({{$post->id}})" class="dropdown-item" type="button">Edit</button>
                    <form method="POST" action="{{ route('deletePost',$post->id)}}">
                        @csrf
                        @method('DELETE')
                            <button class="dropdown-item" type="submit">Delete</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col container pl-5 pt-3">
            <p class="card-text"> {{ substr($post->content,0,400) }}
                {{-- if content is more than 200 characters long display a readmore link--}}
                @if (strlen($post->content) > 400)
                <a href="{{ route('showPost', ['id' => $post->id]) }}">Read More</a>
                @endif
            </p>
        </div>
    </div>
    <div class="row justify-content-end py-3 mr-4 ">
        <small> {{ $post->created_at->diffForHumans() }}</small>
    </div>
    <div class="row justify-content-end pb-2 mr-4 ">
        <a href="{{ route('showPost', ['id' => $post->id]) }}" class="pt-1 px-2 link-dark">
            @if($post->comments == 0)
            @else
            {{ $post->comments }} Comments
            @endif
        </a>
        <a type="button" href="{{ route('showPost', ['id' => $post->id]) }}" class="btn btn-primary btn-sm mb-3">
            <i class="fa-solid fa-comment p-1 "></i>Comment</a>
        </a>

    </div>
</div>
@endforeach


@endsection
