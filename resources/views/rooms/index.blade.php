@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('partials.manage_menu')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-12">
                    <div class="box-head">
                        <h3 class="my-0">Listing</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box-body">
                        <div class="col-10 m-auto">
                            @foreach ($rooms as $room)
                                <div class="row py-2 my-2 border bg-white d-flex">
                                    <div class="col-4 col-md-3 d-flex align-items-center my-1">
                                        <img src="{{ $room->show_photo("thumbnail") }}" alt="">
                                    </div>
                                    <div class="col-8 col-md-6 d-flex align-items-center my-1">
                                        <span>{{ $room->listing_name }}</span>
                                    </div>
                                    <div class="col-12 col-md-3 d-flex align-items-center my-1">
                                        <a href="{{ route('rooms.listing', ['room' => $room->id]) }}" class="btn btn-base btn-size-mini btn-color-main d-flex align-content-center flex-wrap justify-content-center w-100">
                                            <span class="h5 mb-0">Update</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $rooms->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
