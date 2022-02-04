@extends('layouts.app')

@section('content')
<section class="content-header">
      <!-- Main content -->
      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
            </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="personal_info">
                      <form class="form-horizontal" method="POST" action="" id="UserInfoForm">
                          {{ csrf_field() }}
				                  {{ method_field('put') }}
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputFirstName" placeholder="First Name" value="{{ Auth::user()->first_name }}" name="first_name">
                            <span class="text-danger error-text name_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Last Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputLastName" placeholder="Last Name" value="{{ Auth::user()->last_name }}" name="last_name">
                            <span class="text-danger error-text name_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}" name="email">
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
      </section>
@endsection