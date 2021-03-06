@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-8">
            <div class="my-4">

                <div class="title text-center">
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Reset Password</h1>
                </div>

                <div class="col-md-8 m-auto">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="col-8 m-auto">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="E-mail">
                            @include('partials.error_message', ['error' => 'email'])
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-normal bg-main mb-3">Send Password Reset Link</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
