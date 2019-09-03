@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div class="h3 pb-2">
                <span class="h3">Profile Update</span>
            </div>
            <div class="h3 py-2 text-right">
                <a href="{{ route('user.show') }}" class="btn btn-mini bg-main w-100">View my profile</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-12">
                    <div class="box-head">
                        <h3 class="my-0">Your Profile</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box-body">
                        <div class="col-11 col-lg-8 m-auto">

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
                                <div class="form-group">
                                    @if(old('phone'))
                                        <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Phone No">
                                    @elseif(!empty(Auth::user()->phone))
                                        <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ Auth::user()->getPhoneNumber(Auth::user()->phone) }}" placeholder="Phone No">
                                    @else
                                        <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ "" }}" placeholder="Phone No">    
                                    @endif
                                    @include('partials.error_message', ['error' => 'phone'])
                                </div>
                                <div class="form-group">
                                    @if(old('description'))
                                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" cols="10" rows="10" placeholder="Please put some information">{{ old('description') }}</textarea>
                                    @elseif(!empty(Auth::user()->description))
                                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" cols="10" rows="10" placeholder="Please put some information">{{ Auth::user()->description }}</textarea>
                                    @else
                                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" cols="10" rows="10" placeholder="Please put some information">{{ "" }}</textarea>
                                    @endif
                                    @include('partials.error_message', ['error' => 'description'])
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
    </div>
</div>
@endsection
