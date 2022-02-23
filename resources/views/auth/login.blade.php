<!DOCTYPE html>
<html lang="en">

<head>
    <title>Isure || Login Page</title>
    @include('backend.layouts.head')

</head>

<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="p-5">
                    <div class="card">
                        <div class="card-body">
                            @php
                                $settings=DB::table('settings')->get();
                            @endphp                    
                            <div class="text-center">
                                <img class="mb-4" src="@foreach($settings as $data) {{$data->logo}} @endforeach" height="50" alt="logo">
                                <p class="text-gray-900 mb-4">Sign in to start your session</p>
                            </div>
                            <form class="user" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group input-group">
                                    <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Email Address" required autocomplete="email" autofocus>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group input-group">
                                    <input type="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id="exampleInputPassword" placeholder="Password" name="password" required
                                        autocomplete="current-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="row mb-2">
                                    <div class="col-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr>

                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link small" href="{{ route('password.request') }}">
                                        {{ __('I forgot my password') }}
                                    </a>
                                @endif
                            </div>

                            <div class="text-center">
                                @if (Route::has('register'))
                                    <a class="btn btn-link small" href="{{ route('register') }}">
                                        {{ __('Register a new membership') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
