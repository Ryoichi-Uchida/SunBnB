@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-8">
            <div class="my-4">

                <div class="title text-center">
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Sign-up</h1>
                </div>

                <div class="col-md-8 m-auto">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Full name">
                            @include('partials.error_message', ['error' => 'name'])
                        </div>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="E-mail">
                            @include('partials.error_message', ['error' => 'email'])
                        </div>
                        <div class="form-grouｐ">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                            @include('partials.error_message', ['error' => 'password'])
                        </div>
                        <div class="form-grouｐ">
                            <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mt-3" name="password_confirmation" required placeholder="Confirm password">
                            @include('partials.error_message', ['error' => 'password_confirm'])                           
                        </div>
                        <div class="form-grouｐ mt-3 border-bottom">
                            <button type="submit" class="btn btn-normal bg-main mb-3"><span class="h5">Sign-up</span></button>
                        </div>
                    </form>

                    {{-- For facebook --}}
                    <div>
                        <button class="btn btn-normal bg-facebook my-3">
                            <i class="fab fa-facebook-square fa-lg"></i>
                            <span class="h5 pl-2">Sign in with Facebook</span>
                        </button>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
