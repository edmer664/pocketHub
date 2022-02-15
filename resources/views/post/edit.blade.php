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
                        </div>
                    </div>
                </div>
                <div class="card-body text-justify">
                    <form action="{{ route('updatePost',$post->id)}}" method="POST" id="editPost">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="row py-2 mr-3 ml-2">
                            <div class="input-group">
                                <textarea class="form-control custom-control " 
                                    name='content' rows="8" style="resize:none" required> {{ $post->content }}</textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end mx-3">
                            <button type="submit" class="input-group-addon btn btn-primary mb-2 m-2" id="editPostBtn" disabled>Update</button>
                            <a href="{{route('home')}}" class="input-group-addon btn btn-secondary mb-2 m-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

