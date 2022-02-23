@extends('frontend.layouts.master')

@section('title','Laravel-Shop || Register Page')

@section('main-content')
	<!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-5">
                                    <h2>Register</h2>
                                    <p>Please register in order to checkout more quickly</p>
                                    <!-- Form -->
                                    <form class="form" method="post" action="{{route('register.submit')}}">
                                        @csrf
                                        <input type="hidden" name="role" value="user">
                                        <div class="d-grid">
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" name="name" placeholder="Full Name" required="required" value="{{old('name')}}">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                @error('name')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" name="email" placeholder="Email Address" required="required" value="{{old('email')}}">
                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                @error('email')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group input-group">
                                                <input type="password" class="form-control" name="password" placeholder="Password" required="required" value="{{old('password')}}">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                @error('password')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group input-group">
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required="required" value="{{old('password_confirmation')}}">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-between mb-2">
                                                <div class="checkbox d-block mt-0">
                                                    <label class="checkbox-inline" for="remember"><input name="news" id="remember" type="checkbox" {{ old('news') ? 'checked' : '' }}>{{ __('Remember Me') }}</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    {{ __('Sign In') }}
                                                </button>
                                            </div>
                                            <div class="d-grid gap-2 mb-3">
                                                <a href="{{route('login.redirect','facebook')}}" class="btn btn-facebook"><i class="ti-facebook"></i> Sign in using Facebook</a>
                                                <a href="{{route('login.redirect','google')}}" class="btn btn-google"><i class="ti-google"></i> Sign in using Google+</a>
                                                <a href="{{route('login.redirect','github')}}" class="btn btn-github"><i class="ti-github"></i> Sign in using Github</a>
                                            </div>

                                            <div class="text-center">
                                                @if (Route::has('login.form'))
                                                    <a class="lost-pass mx-0" href="{{ route('login.form') }}">
                                                        {{ __('I already have a membership') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ End Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->
@endsection

@push('styles')
<style>
    .shop.login .form .btn{
        margin-right:0;
    }
    .btn-facebook{
        background:#39579A;
    }
    .btn-facebook:hover{
        background:#073088 !important;
    }
    .btn-github{
        background:#444444;
        color:white;
    }
    .btn-github:hover{
        background:black !important;
    }
    .btn-google{
        background:#fa314a;
        color:white;
    }
    .btn-google:hover{
        background:rgb(243, 26, 26) !important;
    }
</style>
@endpush