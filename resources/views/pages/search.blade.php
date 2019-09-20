@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="row">
            
        <div class="col-12 col-lg-9">
            <div class="col-12 text-center">
                <button type="" class="btn btn-base btn-size-mini btn-color-spot mb-3 px-5" id="filter">More filters <i class="fa fa-chevron-down" id="slide-mark"></i></button>
            </div>

            <form action="" method="get" id="search-space" class="hide">
                
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
                            'type' => 'text'
                        ])
                    </div>
                    <div class="col-6 col-md-3 my-1 form-group">
                        @include('partials.label_form',[
                            'name' => 'max_price',
                            'text' => 'Max Price:',
                            'type' => 'text'
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

            <div class="row">
                @foreach ($rooms as $room)
                    @include('partials.room_card')
                @endforeach
            </div>
        
        </div>
        <div class="col-12 col-lg-3">
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
        $('#slider').slider();
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
@endsection
