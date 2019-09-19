@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-12 col-md-3">
            <div class="card">
                @if(!empty($user->socialAccount->image))
                    <img class="card-img-top" src="{{ $user->socialAccount->image }}">
                @else
                    <img class="card-img-top" src="{{ $user->gravatar() }}">
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

        <div class="col-12 col-md-9">
            <div class="row">
                <h1 class="px-3">{{ $user->name }}</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3>Listing</h3>
                </div>
                @foreach ($rooms as $room)
                    @include('partials.room_card')
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 my-4">
                    <div class="pb-3">
                        <h3>Reviews from Guests ({{ $user->totalRate_from_guest() }})</h3>
                        <div class="star" data-score="{{ $user->averageRate_from_guest() }}"></div>
                    </div>
                    @foreach ($reviews_from_guest as $review)
                        @include('partials.review_space')
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-12 my-4">
                    {{-- <h3>Reviews from Hosts</h3> --}}
                    <div class="pb-3">
                        <h3>Reviews from Hosts ({{ $user->totalRate_from_host() }})</h3>
                        <div class="star" data-score="{{ $user->averageRate_from_host() }}"></div>
                    </div>
                    @foreach ($reviews_from_host as $review)
                        @include('partials.review_space')
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')

{{-- For Raty --}}
<script>
    $('.star').raty({
        path: '/images',
        scoreName:'star',
        score: function(){
            $(this).attr('data-score');
        },
        readOnly: true
    });
</script>

@endsection