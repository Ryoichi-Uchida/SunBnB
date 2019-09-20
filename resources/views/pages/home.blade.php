@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row my-5">
        <div class="col-md-7">
            <h1><span class="text-main">SunBnB</span> Book unique homes and experience a city like a local.</h1>
        </div>
    </div>

    <form action="{{ route('search') }}" method="get">
        <div class="row mb-3">
            <div class="form-group col-md-6">
                @include('partials.simple_form',[
                    'name' => 'address',
                    'placeholder' => 'Where are you going?'
                ])
            </div>
            <div class="form-group col-md-3">
                @include('partials.simple_form',[
                    'name' => 'checkin',
                    'placeholder' => 'Start Date'
                ])
            </div>
            <div class="form-group col-md-3">
                @include('partials.simple_form',[
                    'name' => 'checkout',
                    'placeholder' => 'End Date'
                ])
            </div>
        </div>
        <div class="row pb-5 border-bottom d-flex justify-content-center">
            <div class="form-group mx-auto">
                <button type="submit" class="btn btn-base btn-size-mini btn-color-main px-5">Search rooms</button>
            </div>
        </div>
    </form>

    <div class="row py-4 border-bottom">
        <div class="col-12">
            <h1>New Homes</h1>
        </div>
        <div class="row">
            @foreach ($rooms as $room)
                @include('partials.room_card')
            @endforeach
        </div>
    </div>

    <div class="row py-4">
        <div class="col-12">
            <h1>Cities</h1>
        </div>
        @include('partials.city_image', ['image' => 'LA.jpg', 'path' => '/search?address=Los+Angels'])
        @include('partials.city_image', ['image' => 'LD.jpg', 'path' => ''])
        @include('partials.city_image', ['image' => 'MI.jpg', 'path' => ''])
        @include('partials.city_image', ['image' => 'PR.jpg', 'path' => ''])
    </div>

</div>
@endsection

@section('script')

<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.api_key') }}&libraries=places"></script>
<script>
    $(function(){
        $('#address').geocomplete();
    })
</script>


{{-- For Datepicker --}}
<script>
    $(function() {
        $('#checkin').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            maxDate: '3m',
        });

        $('#checkout').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            maxDate: '3m',
        });
    });
</script>

{{-- For Raty --}}
<script>
    $('.star').raty({
        path: '/images',
        score: function(){
            $(this).attr('data-score');
        },
        readOnly: true
    });
</script>
@endsection