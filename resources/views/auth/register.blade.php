@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auths/auth.css') }}">    
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-8">
            <div class="my-4">

                <div class="title text-center">
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Sign-up</h1>
                </div>

                <div class="col-8 m-auto">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Full name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
        
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="E-mail">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
        
                        <div class="form-grouｐ">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-grouｐ">
                            <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mt-3" name="password_confirmation" required  placeholder="Confirm password">
                            @if ($errors->has('password_confirm'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirm') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-grouｐ mt-3 border-bottom w-100">
                            <button type="submit" class="btn btn-success mb-3 w-100 button">Sign-up</button>
                        </div>
                    </form>
                    {{-- For facebook --}}
                    <div>
                        <button class="btn btn-primary my-3 w-100 button">Sign in with Facebook</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
