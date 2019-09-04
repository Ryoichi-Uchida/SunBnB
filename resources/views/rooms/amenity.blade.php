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
                        <h3 class="my-0">Amenities</h3>
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
                                        @include('partials.amenity_choice', ['name' => 'has_tv', 'view' => 'TV', 'is_checked' => $room->has_tv])
                                    </div>
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                        @include('partials.amenity_choice', ['name' => 'has_kitchen', 'view' => 'Kitchen' 'is_checked' => $room->has_kitchen])
                                    </div>
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                         @include('partials.amenity_choice', ['name' => 'has_internet', 'view' => 'Internet' 'is_checked' => $room->has_internet])
                                    </div>
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                        @include('partials.amenity_choice', ['name' => 'has_heating', 'view' => 'Heating' 'is_checked' => $room->has_heating])
                                    </div>
                                    <div class="form-group col-12 col-md-6 col-lg-4">
                                        @include('partials.amenity_choice', ['name' => 'has_air_conditioning', 'view' => 'Air Conditioning' 'is_checked' => $room->has_air_conditioning])
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
