@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="col-12 text-center">
                <button type="" class="btn btn-base btn-size-mini btn-color-spot mb-3 px-5" id="filter">More filters <i class="fa fa-chevron-down" id="slide-mark"></i></button>
            </div>

            <form action="{{ route('search') }}" method="get" id="search-space" class="hide">
                
                <div class="form-group row border-bottom py-3">
                    <div class="col-12 my-1">
                        @include('partials.simple_form',[
                            'name' => 'address',
                            'placeholder' => 'Where are you going?'
                        ])
                    </div>
                </div>

                <div class="form-group row border-bottom py-3">
                    <div class="col-12 col-md-6 my-1">
                        <label for="">Price range with many rooms:<br>(You can also manually set over $ 1000.) </label>
                        <div id="slider"></div>
                    </div>
                    <div class="col-6 col-md-3 my-1 form-group">
                        @include('partials.label_form',[
                            'name' => 'min_price',
                            'text' => 'Min Price:',
                        ])
                    </div>
                    <div class="col-6 col-md-3 my-1 form-group">
                        @include('partials.label_form',[
                            'name' => 'max_price',
                            'text' => 'Max Price:',
                        ])
                    </div>
                </div>
        
                <div class="row border-bottom py-3">
                    <div class="form-group col-md-6">
                        @include('partials.simple_form',[
                            'name' => 'checkin',
                            'placeholder' => 'Start Date'
                        ])
                    </div>
                    <div class="form-group col-md-6">
                        @include('partials.simple_form',[
                            'name' => 'checkout',
                            'placeholder' => 'End Date'
                        ])
                    </div>
                </div>
        
                <div class="row border-bottom  pt-3">
                    <div class="form-group col-6 col-lg-4">
                        @include('partials.check_form', [
                            'name' => 'entire',
                            'text' => 'Entire Room'
                        ])
                    </div>
                    <div class="form-group col-6 col-lg-4">
                        @include('partials.check_form', [
                            'name' => 'private',
                            'text' => 'Private'
                        ])
                    </div>
                    <div class="form-group col-6 col-lg-4">
                        @include('partials.check_form', [
                            'name' => 'shared',
                            'text' => 'Shared'
                        ])
                    </div>
                </div>
        
                <div class="row border-bottom py-3">
                    <div class="form-group col-md-4">
                        @include('partials.listing_item', [
                            'label' => 'Accomodate',
                            'name' => 'accomodate',
                            'required' => "",
                            'disabled' => "",
                            'selected' => session('accomodate'),
                            'options' => [1, 2, 3, 4]
                        ])
                    </div>
                    <div class="form-group col-md-4">
                        @include('partials.listing_item', [
                            'label' => 'Bedrooms',
                            'name' => 'bedroom',
                            'required' => "",
                            'disabled' => "",
                            'selected' => session('bedroom'),
                            'options' => [1, 2, 3, 4]
                        ])
                    </div>
                    <div class="form-group col-md-4">
                        @include('partials.listing_item', [
                            'label' => 'Bathrooms',
                            'name' => 'bathroom',
                            'required' => "",
                            'disabled' => "",
                            'selected' => session('bathroom'),
                            'options' => [1, 2, 3, 4]
                        ])
                    </div>
                </div>
        
                <div class="row border-bottom pt-3">
                    <div class="form-group col-6 col-lg-4">
                        @include('partials.amenity_choice', [
                            'name' => 'has_tv',
                            'view' => 'TV',
                            'checked' => session('has_tv')
                        ])
                    </div>
                    <div class="form-group col-6 col-lg-4">
                        @include('partials.amenity_choice', [
                            'name' => 'has_kitchen',
                            'view' => 'Kitchen',
                            'checked' => session('has_kitchen')
                        ])
                    </div>
                    <div class="form-group col-6 col-lg-4">
                        @include('partials.amenity_choice', [
                            'name' => 'has_internet',
                            'view' => 'Internet',
                            'checked' => session('has_internet')
                        ])
                    </div>
                    <div class="form-group col-6 col-lg-4">
                        @include('partials.amenity_choice', [
                            'name' => 'has_heating',
                            'view' => 'Heating',
                            'checked' => session('has_heating')
                        ])
                    </div>
                    <div class="form-group col-6 col-lg-4">
                        @include('partials.amenity_choice', [
                            'name' => 'has_air_conditioning',
                            'view' => 'Air Conditioning',
                            'checked' => session('has_air_conditioning')
                        ])
                    </div>
                </div>
        
                <div class="row py-3">
                    <div class="form-group mx-auto">
                        <button type="submit" class="btn btn-base btn-size-mini btn-color-main px-5">Search rooms</button>
                    </div>
                </div>
        
            </form>
            
            <div class="row py-4">
                @if (!isset($rooms[0]))
                    <div class="col-12 py-3 text-center text-main">
                        <h1>I'm sorry...</h1>
                        <h1>No rooms match your search</h1>
                    </div>
                @else
                    <div class="col-12">
                        <h1>Search Results</h1>
                    </div>
                    <div class="col-12 py-3">
                        <div id="map" class="w-100 map-height"></div>
                    </div>
                    @foreach ($rooms as $room)
                        @include('partials.room_card')
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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

{{-- For Slider --}}
<script>
    $(function(){
        $('#slider').slider({
            range :true,
            min:0,
            max:1000,
            values:[300,700],
            slide: function(event, pointers){
                $('#min_price').val(pointers.values[0]);
                $('#max_price').val(pointers.values[1]);
            }
        });
    });
</script>

<script>
    $(function(){
        $('#filter').click(function(){
            if($('#filter').hasClass('open')){
                $('#filter').removeClass('open');
                $('#slide-mark').removeClass('fa-chevron-up').addClass('fa-chevron-down')
                $('#search-space').slideUp();
            }else{
                $('#filter').addClass('open');
                $('#slide-mark').removeClass('fa-chevron-down').addClass('fa-chevron-up')
                $('#search-space').slideDown();
            }
        });
    });
</script>

{{-- For Google map --}}
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.api_key') }}&libraries=places"></script>
<script>
    $(function(){
        $('#address').geocomplete();
    })
</script>
<script>
    function initialize() {
        var location = {lat: 10.315699 , lng: 123.88547 };

        @if($rooms->count() > 0)
            location = {lat: {{ $rooms->first()->latitude }}, lng: {{ $rooms->first()->longtitude }} };
        @endif

        var map = new google.maps.Map(document.getElementById('map'), {
            center: location,
            zoom: 12
        });

        var marker, infoWindow;

        // Showing each rooms place & price.
        @foreach($rooms as $room)

            marker = new google.maps.Marker({
                position: { lat: {{ $room->latitude }}, lng: {{ $room->longtitude }} },
                map: map
            });

            // Adding window to show room's price
            var infoWindow = new google.maps.InfoWindow({
                content: "<div id='content'>{{ $room->listing_name }} ($" + {{ $room->price }} + ")</div>"
            });
        
            infoWindow.open(map, marker);

        @endforeach
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection
