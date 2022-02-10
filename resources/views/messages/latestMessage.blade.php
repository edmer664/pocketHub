@extends('layouts.app')

@section('content')
<script>
    var user = {!! auth()->user()->toJson() !!};
  </script>
<div class="row vh-100 ">
    <div class="col-xs-2 col-sm-4 border-right border-primary">
        <div class="py-2">
            <form class=" w-100 navbar-search ">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            {{-- start --}}
            <div id="conv-container">
                {{-- container for list of contancts --}}
            </div>
            
            {{-- end --}}
        </div>
    </div>

    <div class="col  d-none d-sm-inline-block ">
        <div class="d-flex  flex-column  w-100 h-100 ">
            <div class="p-2 ">
                <div class="py-5" id="conversation-details">
                    <img id="user-image" src="img/undraw_profile.svg" class="rounded-circle float-left m-2 " width="50px"
                        alt="...">
                    <h5 id="user-name" class="font-weight-bold p-3"></h5>
                </div>
                <hr>
            </div>
            <div id="message-container" class="p-2  h-100 overflow-auto">

                {{-- message style --}}
                <div class="d-flex justify-content-start mb-4">
                    <div class="img_cont_msg">
                        <img src="img/undraw_profile.svg"
                        height="50px" width="50px" class="rounded-circle">
                    </div>
                    <p class="p-2  mx-2 my-1 rounded bg-secondary text-white">
                        . . .
                        
                    </p>
                </div>
                {{-- end message style --}}


                {{-- message stlye 2 --}}
                <div class="d-flex justify-content-end mb-4">
                    <p class="p-2 my-1 mx-2 rounded bg-warning text-white">
                        . . .
                    </p>
                    <div class="img_cont_msg ">
                        <img src="img/undraw_profile.svg"
                        height="50px" width="50px" class="rounded-circle">
                        
                    </div>
                </div>
                {{-- end message stlye 2 --}}
            </div>
            
            <div class="align-items-end ">
                <div class="card-footer ">
                    <form  class="input-group" method="POST">
                        {{ csrf_field() }}
                        
                        <textarea name="body" class="form-control type_msg" placeholder="Type your message..."></textarea>
                        <button class="input-group-append" type="submit">
                            <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='{{ url('storage/message.js') }}'></script>
@endsection
