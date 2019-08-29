@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-8">
            <div class="my-4">

                <div class="title text-center">
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Profile Update</h1>
                </div>

                <div class="col-8 m-auto">
                    <form method="POST" action="{{ route('user.update') }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') != null ? old('name') : Auth::user()->name }}" required>
                            @include('partials.error_message', ['error' => 'name'])
                        </div>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') != null ? old('email') : Auth::user()->email }}" required>
                            @include('partials.error_message', ['error' => 'email'])
                        </div>
                        <div class="form-grouｐ">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password">
                            @include('partials.error_message', ['error' => 'password'])
                        </div>
                        <div class="form-grouｐ">
                            <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mt-3" name="password_confirmation" placeholder="Confirm password">
                            @include('partials.error_message', ['error' => 'password_confirm'])                           
                        </div>
                        <div class="form-grouｐ mt-5">
                            <button type="submit" class="btn btn-normal bg-main mb-3"><span class="h5">Update</span></button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
