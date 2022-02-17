@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block ">
                            <img class="w-100 h-100 " src="{{ asset('assets/img/login_bg.svg')}}" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Login') }}</h1>
                                </div>
                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                            id="exampleInputEmail" aria-describedby="emailHelp" required autocomplete="email" autofocus
                                            placeholder="{{ __('Email Address') }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                                            id="exampleInputPassword" placeholder="{{ __('Password') }}">
                                            
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary bg-gradient-danger border-0 btn-user btn-block">
                                        {{ __('Login') }}
                                    </button>                            
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small text-danger"  href="{{ route('register') }}">Create an Account!</a>
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
