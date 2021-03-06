@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="content">
        <div class="row w-100">
            <div class="col-md-3 text-center m-3">
                <div class="d-flex flex-column align-items-center">
                @if (Auth::user()->avatar_path == null)
                <img class=" py-2 rounded-circle default-avatar" width="200" height="200"
                    src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
                    alt="">
                @else
                <img class="py-2 rounded-circle avatar-hide" width="200" height="200"
                    src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
                @endif
                <img class=" py-2 rounded-circle avatar d-none" width="200" height="200"
                    src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop">
                    Upload Image
                </button>
            </div>
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Upload Avatar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" id="uploadImage"
                                    action="{{ route('uploadAvatar') }}">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="file" name="avatar" placeholder="Choose image" id="avatar">
                                                <br />
                                                <span class="text-danger error-text avatar"></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" id="uploadImageBtn" disabled>Upload</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <ul class="nav nav-tabs" id="tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active text-danger" id="profile-tab" data-toggle="tab" href="#profileInfo" role="tab"
                                aria-controls="profile" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-danger" id="password-tab" data-toggle="tab" href="#changePassword" role="tab"
                                aria-controls="password" aria-selected="false">Password</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-danger" id="password-tab" data-toggle="tab" href="#deactivate" role="tab"
                                aria-controls="password" aria-selected="false">Deactivate</a>
                        </li>
                    </ul>
                    <div class="tab-content w-100" id="tabContent">
                        <div class="tab-pane fade show active" id="profileInfo" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="active tab-pane" id="personal_info">
                                <form class="form-horizontal pt-3" method="POST" action="{{ route('updateInfo') }}"
                                    id="userInfoForm">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputFirstName"
                                                placeholder="First Name" value="{{ Auth::user()->first_name }}"
                                                name="first_name">
                                            <span class="text-danger error-text first_name"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputLastName"
                                                placeholder="Last Name" value="{{ Auth::user()->last_name }}"
                                                name="last_name">
                                            <span class="text-danger error-text last_name"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                                                value="{{ Auth::user()->email }}" name="email">
                                            <span class="text-danger error-text email"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success" id="userInfoFormBtn" disabled>Save Changes</button>
                                            <a class="btn btn-secondary"  href="{{ route('profile') }}">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="password-tab">
                            <div class="active tab-pane" id="personal_password">
                                <form class="form-horizontal  pt-3" method="POST" action="{{ route('changePassword') }}"
                                    id="userPasswordForm">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    <div class="form-group row">
                                        <label for="inputCurrent" class="col-sm-2 col-form-label">Current </label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="currentPassword"
                                                placeholder="Current Password" name="currentPassword">
                                            <span class="text-danger error-text currentPassword"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputNew" class="col-sm-2 col-form-label">New</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newPassword"
                                                placeholder="New Password" name="newPassword">
                                            <span class="text-danger error-text newPassword"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputReType" class="col-sm-2 col-form-label">Re-type new</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="reTypePassword"
                                                placeholder="Re-type password" name="reTypePassword">
                                            <span class="text-danger error-text reTypePassword"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success" id="userPasswordFormBtn" disabled>Save Changes</button>
                                            <a class="btn btn-secondary"  href="{{ route('profile') }}">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="deactivate" role="tabpanel" aria-labelledby="deactivate-tab">
                            <div class="active tab-pane" id="deactivate">
                                <form class="form-horizontal  pt-3" method="POST" action="{{ route('deactivate') }}"
                                    id="deactivateForm">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <div class="form-group row">
                                        <label for="inputCurrent" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Email" name="email">
                                            <span class="text-danger error-text email"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputReType" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Password" name="password">
                                            <span class="text-danger error-text password"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger" id="deactivateFormBtn" disabled>Deactivate</button>
                                            <a class="btn btn-secondary"  href="{{ route('profile') }}">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>
@endsection
