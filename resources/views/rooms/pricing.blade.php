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
                        <h3 class="my-0">Pricing</h3>
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
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-12 col-md-10">
                                        <label for="price" class="">Price</label>
                                        <input type="text" name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') ?? $room->price }}" required>
                                        @include('partials.error_message', ['error' => 'price'])
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
