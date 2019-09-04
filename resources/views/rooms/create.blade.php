@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="box-head">
                <h3 class="my-0">Create your beautiful place</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="box-body">
                <div class="col-10 m-auto">
                    <form action="{{ route('room.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="home_type" class="">Home Type</label>
                                <select name="home_type" id="" class="form-control custom-select" required>
                                    <option value="">Select..</option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="House">House</option>
                                    <option value="Bed & Breakfast">Bed & Breakfast</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="room_type" class="">Room Type</label>
                                <select name="room_type" id="" class="form-control custom-select" required>
                                    <option value="">Select..</option>
                                    <option value="Entire">Entire</option>
                                    <option value="Private">Private</option>
                                    <option value="Shared">Shared</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="accomodate" class="">Accomodate</label>
                                <select name="accomodate" id="" class="form-control custom-select" required>
                                    <option value="">Select..</option>
                                    @for ($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="bedroom" class="">Bedrooms</label>
                                <select name="bedroom" id="" class="form-control custom-select" required>
                                    <option value="">Select..</option>
                                    @for ($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="bathroom" class="">Bathrooms</label>
                                <select name="bathroom" id="" class="form-control custom-select" required>
                                    <option value="">Select..</option>
                                    @for ($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
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
@endsection
