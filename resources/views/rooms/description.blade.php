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
                        <h3 class="my-0">Description</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box-body">
                        <div class="col-10 m-auto">
                            <form action="{{ route('rooms.update', ['room' => $room->id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-12 col-md-10">
                                        <label for="listing_name" class="">Listing name</label>
                                        <input type="text" name="listing_name" class="form-control{{ $errors->has('listing_name') ? ' is-invalid' : '' }}" value="{{ old('listing_name') ?? $room->listing_name }}" required>
                                        @include('partials.error_message', ['error' => 'listing_name'])
                                    </div>
                                    <div class="form-group col-12 col-md-10">
                                        <label for="summary" class="">Summary (Optional)</label>
                                        <textarea class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" name="summary" cols="10" rows="10">{{ old('summary') ?? $room->summary }}</textarea>
                                        @include('partials.error_message', ['error' => 'summary'])
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
