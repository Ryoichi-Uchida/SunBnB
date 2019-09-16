@extends('layouts.app')

@section('content')
<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <img class="w-100" src="{{ $room->show_photo("original") }}">
        </div>
    </div>
    <div class="row my-4">

        {{-- Left space --}}
        <div class="col-12 col-lg-7">

            {{--　Room summary --}}
            <div class="row border-bottom py-3">
                <div class="col-12 col-md-6 col-lg-8">
                    <h1>{{ $room->listing_name }}</h1>
                    <h3>{{ $room->address }}</h3>
                </div>
                <div class="col-12 col-md-6 col-lg-4 text-center">
                    @if($room->user->socialAccount)
                        <img class="rounded-circle img-lg-fb" src="{{ $room->user->socialAccount->image }}">
                    @else
                        <img class="rounded-circle" src="{{ $room->user->gravatar(150) }}">
                    @endif
                    <h4 class="">{{ $room->user->name }}</h4>
                </div>
            </div>

            {{-- Room feature --}}
            <div class="row text-center border-bottom pt-3 pb-2">
                @include('partials.room_feature', ['fa' => 'fa fa-home', 'feature' => $room->room_type, 'name' => ''])
                @include('partials.room_feature', ['fa' => 'fas fa-users', 'feature' => $room->accomodate, 'name' => 'Guest'])
                @include('partials.room_feature', ['fa' => 'fas fa-hot-tub', 'feature' => $room->bathroom, 'name' => 'Bathroom'])
                @include('partials.room_feature', ['fa' => 'fas fa-bed', 'feature' => $room->bedroom, 'name' => 'Bedroom'])
            </div>

            {{-- Room description --}}
            <div class="row border-bottom py-3">
                <div class="col-12">
                    <h2 class="mb-3">About This Listing</h2>
                    <h5>{{ $room->summary }}</h5>
                </div>
            </div>

            {{-- Room Amenities --}}
            <div class="row border-bottom py-3">
                <div class="col-12 mb-3">
                    <h2>Amenities</h2>
                </div>
                @include('partials.amenity_show', ['checked' => $room->has_tv, 'name' => 'TV'])
                @include('partials.amenity_show', ['checked' => $room->has_kitchen, 'name' => 'Kitchen'])
                @include('partials.amenity_show', ['checked' => $room->has_internet, 'name' => 'Internet'])
                @include('partials.amenity_show', ['checked' => $room->has_heating, 'name' => 'Heating'])
                @include('partials.amenity_show', ['checked' => $room->has_air_conditioning, 'name' => 'Air Conditioning'])
            </div>

            {{-- Room Images slider (Using "Swiper") --}}
            <div class="row py-3">
                <div class="col-12">
                    <div class="swiper-container" id="slide" data-num="{{ $room->photos->count() }}">
                        <div class="swiper-wrapper">
                            @foreach ($room->photos as $photo)
                                <div class="swiper-slide"><img class="w-100" src="{{ $photo->show("original") }}"></div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination swiper-pagination-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                        <div class="swiper-button-next swiper-button-white"></div>
                    </div>
                </div>
            </div>

            {{-- Reviews area --}}
            <div class="row py-3 border-bottom">
                <div class="col-12">
                    <h2>2 Reviews</h2>
                    <h5 class="text-center">There are no reviews.</h5>
                </div>
            </div>

            {{-- Map area --}}
            <div class="row py-3 border-bottom">
                <div class="col-12">
                    <div id="map" class="map-height"></div>
                </div>
            </div>

            {{-- Introductin of nearby rooms --}}
            <div class="row py-3">
                <div class="col-12">
                    <h2>Nearbys</h2>
                    @foreach ($room->near_rooms() as $near_room)
                        <div class="col-12 col-sm-6 col-lg-4 my-2">
                            <div class="card">
                                <img class="card-img-top" src="{{ $near_room->show_photo("medium") }}">
                                <div class="card-body py-2">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5><a href="{{ route('rooms.show', ['room' => $near_room->id]) }}">{{ $near_room->listing_name }}</a></h5>
                                            <p>{{ round($near_room->distance, 2) }}km away</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Right space --}}
        <div class="col-12 col-lg-5">
            <div class="row">
                <div class="col-12">
                    <div class="box-head">
                        <h4 class="my-0">Reservation</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box-body pr-2 py-3">
                        <div class="text-right">
                            <h5><span class="text-main h3">$ {{ $room->price }}</span> Per Night</h5>
                        </div>
                        <form action="{{ route('reservations.store', ['room' => $room->id]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="">Check In :</label>
                                    <input type="text" name="checkin" id="checkin" class="form-control" required autocomplete="off">
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="">Check Out :</label>
                                    <input type="text" name="checkout" id="checkout" class="form-control" required autocomplete="off">
                                </div>
                                <div class="col-12 form-group mx-auto my-3">
                                    <button type="submit" class="btn btn-base btn-size-mini btn-color-main px-5 w-100">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
{{-- For Swiper --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script>
    $(function() {

        // Preparation getting how many photos does this room has
        var target = document.getElementById('slide');

        // If the room has two or more photos...
        if(target.getAttribute('data-num') != 1){
            // Making new slide function
            var mySwiper = new Swiper ('.swiper-container', {
                // options
                loop: true,
                autoplay: true,
                speed: 1000,
                watchOverflow: true,
                effect: 'coverflow',
                pagination: {
                el: '.swiper-pagination',
                clickable: true
                },
                navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
                },
                scrollbar: {
                el: '.swiper-scrollbar',
                },
            });
        }

    });
</script>

{{-- For Google map --}}
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.api_key') }}"></script>
<script>
    function initialize() {
        var location = {lat: {{ $room->latitude }} , lng: {{ $room->longtitude }} };

        var map = new google.maps.Map(document.getElementById('map'), {
            center: location,
            zoom: 14
        });

        var marker = new google.maps.Marker({
            position: location,
            map: map
        });

        // Adding window to show room's photo
        var infoWindow = new google.maps.InfoWindow({
            content: "<div id='content'><img class='w-100' src='{{ $room->show_photo("medium") }}'></div>"
        });
    
        infoWindow.open(map, marker);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection

{{-- For Datepicker --}}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $('#checkin').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('#checkout').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
