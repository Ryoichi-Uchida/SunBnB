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
                    <form action="{{ route('rooms.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                @include('partials.listing_item', [
                                    'label' => 'Home Type',
                                    'name' => 'home_type',
                                    'required' => "required",
                                    'disabled' => "disabled",
                                    'selected' => "",
                                    'options' => ['Apartment', 'House', 'Bed & Breakfast']
                                ])
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                @include('partials.listing_item', [
                                    'label' => 'Room Type',
                                    'name' => 'room_type',
                                    'required' => "required",
                                    'disabled' => "disabled",
                                    'selected' => "",
                                    'options' => ['Entire', 'Private', 'Shared']
                                ])
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                @include('partials.listing_item', [
                                    'label' => 'Accomodate',
                                    'name' => 'accomodate',
                                    'required' => "required",
                                    'disabled' => "disabled",
                                    'selected' => "",
                                    'options' => [1, 2, 3, 4]
                                ])
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                @include('partials.listing_item', [
                                    'label' => 'Bedrooms',
                                    'name' => 'bedroom',
                                    'required' => "required",
                                    'disabled' => "disabled",
                                    'selected' => "",
                                    'options' => [1, 2, 3, 4]
                                ])
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                @include('partials.listing_item', [
                                    'label' => 'Bathrooms',
                                    'name' => 'bathroom',
                                    'required' => "required",
                                    'disabled' => "disabled",
                                    'selected' => "",
                                    'options' => [1, 2, 3, 4]
                                ])
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
