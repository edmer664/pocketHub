@extends('layouts.app')

@section('content')
<div class="card border-left-primary shadow">
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
<div class="card my-2 ">
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
        <div class="col pt-3">
            <h5 class="card-title font-weight-bolder">{{ $post->first_name . " " . $post->last_name }} </h5>
        </div>
        <div class="col text-right p-3">
            @if(Auth::user()->id == $post->user->id)
                <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">Edit</button>
                        <button class="dropdown-item" type="button">Delete</button>
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
        <a  href="{{ route('showPost', ['id' => $post->id]) }}" class="pt-1 px-2 link-dark">
            12 Comments
        </a>
        <a type="button" href="{{ route('showPost', ['id' => $post->id]) }}" class="btn btn-primary btn-sm mb-3">
            <i class="fa-solid fa-comment p-1 "></i>Add Comment</a>
        </a>
    </div>
</div>
{{-- <div class="card my-2 container">
    <div class="row">
        <div class="col-auto pt-1">
            <img class="rounded-circle img-fluid" width="60" src="img/undraw_profile.svg" alt="">
        </div>
        <div class="col pt-3">
            <h5 class="card-title font-weight-bolder">Jane Doe </h5>
        </div>

    </div>
    <div class="row">
        <div class="col container pl-5 pt-2">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                aliqua. Integer quis auctor elit sed. Facilisis magna etiam tempor
                orci eu. Risus ultricies tristique nulla aliquet enim. Turpis
                egestas maecenas pharetra convallis posuere morbi leo. Mi proin sed
                libero enim. Pretium fusce id velit ut tortor pretium. Pharetra
                magna ac placerat vestibulum lectus mauris ultrices eros in. At in
                tellus integer feugiat scelerisque varius morbi enim. Adipiscing
                enim eu turpis egestas pretium aenean. Velit egestas dui id ornare
                arcu odio ut sem nulla. Imperdiet sed euismod nisi porta lorem
                mollis aliquam.

                Purus sit amet luctus venenatis. Semper quis lectus nulla at
                volutpat. <a href="post.html">Read More</a></p>
        </div>
    </div>
    <div class="row justify-content-end pb-2  mr-3">
        <a class="pt-2 px-2 link-dark">
            12 Comments
        </a>
        <a type="button" class="btn btn-primary btn-sm mb-3" href="post.html"><i class="fa-solid fa-comment p-1"></i>Add
            Comment</a>
    </div>
</div> --}}
@endforeach


@endsection
