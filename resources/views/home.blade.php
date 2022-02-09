@extends('layouts.app')

@section('content')
<div class="row">
    <div class="w-100">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body w-100">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto mr-2">
                        @if (Auth::user()->avatar_path == null)
                        <img class="rounded-circle img-fluid" width="60"
                            src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                            alt="">
                        @else
                        <img class="rounded-circle img-fluid" width="60"
                            src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
                        @endif

                    </div>
                    <div class="col ">
                        <form action="{{ route('createPost') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <textarea class="form-control custom-control" placeholder="What's in your Mind?"
                                   name='content' rows="3" style="resize:none"></textarea>
                                <button type="submit" class="input-group-addon btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 mt-3">
        @foreach ($posts as $post)
            <div class="card shadow mb-4">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-auto  p-3">
                            @if ($post->author_avatar == null)
                            <img class="rounded-circle img-fluid" width="60"
                                src="https://avatars.dicebear.com/api/initials/{{substr($post->first_name, 0, 1) . substr($post->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                                alt="">
                            @else
                            <img class="rounded-circle img-fluid" width="60"
                                src="{{ url('storage/avatars/' . $post->author_avatar) }}" alt="">
                            @endif

                        </div>
                        <div class="col">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->first_name . " " . $post->last_name }}</h5>
                                <p class="card-text">
                                    {{ substr($post->content,0,400) }}
                                    {{-- if content is more than 200 characters long display a readmore link--}}
                                    @if (strlen($post->content) > 400)
                                        <a href="{{ route('showPost', ['id' => $post->id]) }}">Read More</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center ">
                        <div class="col align-items-center m-2">
                            {{-- expand icon --}}
                            <a href="{{ route('showPost', ['id' => $post->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-expand"></i>
                            </a>
                            
                        </div>
                        <div class="col text-right mx-2">      
                                <p class="card-text">
                                    <small class="text-muted">
                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
