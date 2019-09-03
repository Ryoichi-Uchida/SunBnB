@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div class="card">
                @if(!empty(Auth::user()->socialAccount->image))
                    <img class="card-img-top" src="{{ Auth::user()->socialAccount->image }}">
                @else
                    <img class="card-img-top" src="{{ Auth::user()->gravatar() }}">
                @endif
                <h3 class="card-header bg-menu">Verfication</h3>
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <ul class="h5 list pl-4">
                                <li class="py-2">Email Address</li>
                                <li class="py-2">Phone Number</li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="h5 list pl-0">
                                <li class="text-main py-2">✔︎</li>
                                <li class="text-main py-2">✔︎</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
        </div>

    </div>
</div>
@endsection
