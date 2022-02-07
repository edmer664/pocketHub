@extends('layouts.app')
@section('content')
    {{-- make a show post page with add comments using bootstrap 4 --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            {{ $post->author_id }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection