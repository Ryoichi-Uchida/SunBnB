@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('partials.room_menu')
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
                            <form action="{{ route('room.update', ['room' => $room->id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                        <label for="home_type" class="">Home Type</label>
                                        <select name="home_type" id="" class="form-control custom-select" required>
                                            <option value="Apartment" {{ $room->home_type == 'Apartment' ? 'selected' : "" }}>Apartment</option>
                                            <option value="House" {{ $room->home_type == 'House' ? 'selected' : "" }}>House</option>
                                            <option value="Bed & Breakfast" {{ $room->home_type == 'Bed & Breakfast' ? 'selected' : "" }}>Bed & Breakfast</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                        <label for="room_type" class="">Room Type</label>
                                        <select name="room_type" id="" class="form-control custom-select" required>
                                            <option value="Entire" {{ $room->room_type == 'Entire' ? 'selected' : "" }}>Entire</option>
                                            <option value="Private" {{ $room->room_type == 'Private' ? 'selected' : "" }}>Private</option>
                                            <option value="Shared" {{ $room->room_type == 'Shared' ? 'selected' : "" }}>Shared</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                        <label for="accomodate" class="">Accomodate</label>
                                        <select name="accomodate" id="" class="form-control custom-select" required>
                                            @for ($i = 1; $i <= 4; $i++)
                                                <option value="{{ $i }}" {{ $room->accomodate == $i ? 'selected' : "" }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                        <label for="bedroom" class="">Bedrooms</label>
                                        <select name="bedroom" id="" class="form-control custom-select" required>
                                            @for ($i = 1; $i <= 4; $i++)
                                                <option value="{{ $i }}" {{ $room->bedroom == $i ? 'selected' : "" }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                        <label for="bathroom" class="">Bathrooms</label>
                                        <select name="bathroom" id="" class="form-control custom-select" required>
                                            @for ($i = 1; $i <= 4; $i++)
                                                <option value="{{ $i }}" {{ $room->bathroom == $i ? 'selected' : "" }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Save</button>
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
