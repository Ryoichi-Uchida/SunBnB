@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-8">
            <div class="my-4">

                <div class="title text-center">
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Login</h1>
                </div>

                <div class="col-md-8 m-auto">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail">
                            @include('partials.error_message', ['error' => 'email'])
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                            @include('partials.error_message', ['error' => 'password'])
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-grouｐ mt-3 border-bottom">
                            <button type="submit" class="btn btn-normal mb-3"><span class="h5">Login</span></button>
                        </div>

                    </form>

                    {{-- For facebook --}}
                    <div>
                        <a href="{{ route('redirect', ['provider' => 'facebook']) }}" class="btn btn-facebook my-3 d-flex align-content-centerd-flex align-content-center flex-wrap justify-content-center">
                            <i class="fab fa-facebook-square fa-lg"></i>
                            <span class="h5 pl-2 mb-0">Sign in with Facebook</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
