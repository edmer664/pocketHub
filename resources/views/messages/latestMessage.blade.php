@extends('layouts.app')

@section('content')
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

            <div class="card border-0 py-4 ">
                <div class=" border-bottom border-dark ">
                    <div class="d-flex">
                        <div class="pr-2">
                            @if (Auth::user()->avatar_path == null)
                            <img class="rounded-circle img-fluid m-3" width="60" height="60"
                                src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                                alt="">
                            @else
                            <img class="rounded-circle img-fluid" width="60" height="60"
                                src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
                            @endif
                        </div>
                        <div class="pb-2">
                            <span>Jane Doe</span>
                            <p> Hi, I'm Fine Thank you <small class="pl-5">3 mins</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col  d-none d-sm-inline-block ">
        <div class="d-flex  flex-column  w-100 h-100 ">
            <div class="p-2 ">
                <div py-5>
                    <img src="img/undraw_profile.svg" class="rounded-circle float-left m-2 " width="50px"
                        alt="...">
                    <h5 class="font-weight-bold p-3">Jane Doe</h5>
                </div>
                <hr>
            </div>
            <div class="p-2  h-100">
                <div class="d-flex justify-content-start mb-4">
                    <div class="img_cont_msg">
                        <img src="img/undraw_profile.svg"
                        height="50px" width="50px" class="rounded-circle">
                    </div>
                    <p class="p-2  mx-2 my-1 rounded bg-secondary text-white">
                        Hi, how are you jane?
                        
                    </p>
                </div>
                <div class="d-flex justify-content-end mb-4">
                    <p class="p-2 my-1 mx-2 rounded bg-warning text-white">
                        Hi, I'm Fine Thank you 
                    </p>
                    <div class="img_cont_msg ">
                        <img src="img/undraw_profile.svg"
                        height="50px" width="50px" class="rounded-circle">
                        
                    </div>
                </div>
            </div>
            
            <div class="align-items-end ">
                <div class="card-footer ">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
