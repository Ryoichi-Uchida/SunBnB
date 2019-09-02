@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-8">
            <div class="my-4">

                <div class="title text-center">
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Verify Your Email Address</h1>
                </div>

                <div class="col-md-8 m-auto">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>

                <div class="col-8 m-auto">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
