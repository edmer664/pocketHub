@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="assets/img/undraw_profile.svg" class="w-100 py-2 rounded-circle" alt="...">
                    <button class="btn btn-primary ">Change Image</button>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="true">Profile</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab"
                                    aria-controls="password" aria-selected="false">Password</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="active tab-pane" id="personal_info">
                                    <form class="form-horizontal pt-3" method="POST" action="" id="UserInfoForm">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputFirstName"
                                                    placeholder="First Name" value="{{ Auth::user()->first_name }}"
                                                    name="first_name">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">New</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputLastName"
                                                    placeholder="Last Name" value="{{ Auth::user()->last_name }}"
                                                    name="last_name">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEmail"
                                                    placeholder="Email" value="{{ Auth::user()->email }}" name="email">
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <div class="active tab-pane" id="personal_info">
                                    <form class="form-horizontal  pt-3" method="POST" action="" id="UserInfoForm">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group row">
                                            <label for="inputCurrent" class="col-sm-2 col-form-label">Current </label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputCurrent"
                                                    placeholder="Current" name="current">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputNew" class="col-sm-2 col-form-label">New</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputNew"
                                                    placeholder="New" name="last_name">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputReType" class="col-sm-2 col-form-label">Re-type New</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputReType"
                                                    placeholder="Re-type" name="email">
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Save Changes</button>
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
