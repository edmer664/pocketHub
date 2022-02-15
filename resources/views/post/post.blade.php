@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center w-100">
                        <div class="row w-100 border-1">
                            <div class="col-auto p-2 pl-2">
                                @if ($user->avatar_path == null)
                                <img class="rounded-circle " width="60" height="60"
                                    src="https://avatars.dicebear.com/api/initials/{{substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                                    alt="">
                                @else
                                <img class="rounded-circle " width="60" height="60"
                                    src="{{ url('storage/avatars/' . $user->avatar_path) }}" alt="">
                                @endif
                            </div>
                            <div class="col">
                                <h4 class="mt-4"> {{ $user->first_name . " " . $user->last_name }} </h4>
                            </div>
                            <div class="col-auto ">
                                @if ($user->id == Auth::user()->id)
                                <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <a href="{{ route('showEditForm',$post->id)}}" class="dropdown-item">Edit</a>
                                    <form method="POST" action="{{ route('deletePost',$post->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" type="submit">Delete</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body text-justify">
                    {{ $post->content }}
                </div>
                <div class="card-footer">
                    <div class="row justify-content-end mr-3">
                        <small>
                            {{ $post->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            </div>
            <h3 class="my-3" style="color:#4267d6">Comments</h3>
            <div class="card border-left-primary shadow container">
                <div class="row  ">
                    <div class="col-auto py-3 d-none d-sm-inline-block">
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
                        <form action="{{ route('addComment', $post->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row py-2 mx-3">
                                <div class="input-group">
                                    <textarea class="form-control custom-control " placeholder="What's in your Mind?"
                                        name='content' id="comment" rows="3" style="resize:none"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-end mx-3">
                                <button type="submit" class="input-group-addon btn btn-primary mb-2">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @foreach ($comments as $comment)
            <div class="card my-2 container">

                <div class="row">
                    <div class="col-auto pt-1">
                        @if ($comment->user->avatar_path == null)
                        <img class="rounded-circle " width="60" height="60"
                            src="https://avatars.dicebear.com/api/initials/{{substr($comment->user->first_name, 0, 1) . substr($comment->user->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                            alt="">
                        @else
                        <img class="rounded-circle " width="60" height="60"
                            src="{{ url('storage/avatars/' . $comment->user->avatar_path) }}" alt="">
                        @endif
                    </div>
                    <div class="col pt-3">
                        <h5 class="card-title font-weight-bolder">
                            {{$comment->user->first_name . " " . $comment->user->last_name }} </h5>
                    </div>
                    @if (Auth::user()->id == $comment->user_id)
                    <div class="col text-right p-3">
                        <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <form method="POST" action="{{ route('deleteComment',$comment->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col container pl-5 pt-3">
                        <p class="card-text">
                            {{ $comment->content }}
                        </p>
                    </div>
                </div>
                <div class="row justify-content-end pb-2 mr-4 ">
                    <small> {{ $comment->created_at->diffForHumans() }}</small>
                </div>

            </div>
            @endforeach
        </div>
    </div>




    @endsection
