@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row my-5">
        <div class="col-md-7">
            <h1><span class="text-main">SunBnB</span> Book unique homes and experience a city like a local.</h1>
        </div>
    </div>

    <form action="" method="get">
        @csrf
        <div class="row mb-3">
            <div class="form-group col-md-6">
                <input type="text" name="address" id="" class="form-control input-height" placeholder="Where are you going?" autocomplete="off">
            </div>
            <div class="form-group col-md-3">
                <input type="text" name="checkin" id="checkin" class="form-control input-height" placeholder="Start Date" autocomplete="off">
            </div>
            <div class="form-group col-md-3">
                <input type="text" name="checkout" id="checkout" class="form-control input-height" placeholder="End Date" autocomplete="off">
            </div>
        </div>

        <div class="row pb-5 border-bottom d-flex justify-content-center">
            <a href="" class="btn btn-base btn-size-mini btn-color-main d-flex align-content-center flex-wrap justify-content-center w-25">
                <span class="h5 mb-0">Search</span>
            </a>
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
        @include('partials.city_image', ['image' => 'LA.jpg'])
        @include('partials.city_image', ['image' => 'LD.jpg'])
        @include('partials.city_image', ['image' => 'MI.jpg'])
        @include('partials.city_image', ['image' => 'PR.jpg'])
    </div>

</div>
@endsection

@section('script')

{{-- For Datepicker --}}
<script>
    $(function() {
        $('#checkin').datepicker({

        });

        $('#checkout').datepicker({

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