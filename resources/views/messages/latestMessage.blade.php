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
                    <input id="search-bar" type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button onclick="searchUser()" class="btn btn-primary" type="button">
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
    <div class="col d-none d-sm-inline-block ">
        <div class="d-flex  flex-column  w-100 h-100 ">
            <div class="p-2 ">
                <div class="py-5" id="conversation-details">
                    <img id="user-image" src="img/undraw_profile.svg" class="rounded-circle float-left m-2 " width="50px"
                        alt="...">
                    <h5  id="user-name" class="font-weight-bold p-3">Jane Doe</h5>
                </div>
                <hr>
            </div>
            <div  id="message-container" class="p-2  h-100">
                
            </div>

            <div class="align-items-end ">
                <div class="card-footer ">
                    <form  id='message_form' class="input-group" method="POST">
                        {{ csrf_field() }}
                        
                        <textarea id="message_content" name="body" class="form-control type_msg" placeholder="Type your message..."></textarea>
                        <button id="send-btn" class="input-group-append" type="submit">
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
