@if(Route::currentRouteName() == 'room.create')

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
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
                </select>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="bedroom" class="">Bedrooms</label>
                <select name="bedroom" id="" class="form-control custom-select" required>
                    <option value="">Select..</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
                </select>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="bathroom" class="">Bathrooms</label>
                <select name="bathroom" id="" class="form-control custom-select" required>
                    <option value="">Select..</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
                </select>
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Save</button>
        </div>
    </form>

@elseif(Route::currentRouteName() == 'room.listing')
    
    <form action="{{ route('room.update', ['room' => $room->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="home_type" class="">Home Type</label>
                <select name="info[home_type]" id="" class="form-control custom-select" required>
                    <option value="Apartment" {{ $room->home_type == 'Apartment' ? 'selected' : "" }}>Apartment</option>
                    <option value="House" {{ $room->home_type == 'House' ? 'selected' : "" }}>House</option>
                    <option value="Bed & Breakfast" {{ $room->home_type == 'Bed & Breakfast' ? 'selected' : "" }}>Bed & Breakfast</option>
                </select>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="room_type" class="">Room Type</label>
                <select name="info[room_type]" id="" class="form-control custom-select" required>
                    <option value="Entire" {{ $room->room_type == 'Entire' ? 'selected' : "" }}>Entire</option>
                    <option value="Private" {{ $room->room_type == 'Private' ? 'selected' : "" }}>Private</option>
                    <option value="Shared" {{ $room->room_type == 'Shared' ? 'selected' : "" }}>Shared</option>
                </select>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="accomodate" class="">Accomodate</label>
                <select name="info[accomodate]" id="" class="form-control custom-select" required>
                    <option value="1" {{ $room->accomodate == 1 ? 'selected' : "" }}>1</option>
                    <option value="2" {{ $room->accomodate == 2 ? 'selected' : "" }}>2</option>
                    <option value="3" {{ $room->accomodate == 3 ? 'selected' : "" }}>3</option>
                    <option value="4" {{ $room->accomodate == 4 ? 'selected' : "" }}>4+</option>
                </select>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="bedroom" class="">Bedrooms</label>
                <select name="info[bedroom]" id="" class="form-control custom-select" required>
                    <option value="1" {{ $room->bedroom == 1 ? 'selected' : "" }}>1</option>
                    <option value="2" {{ $room->bedroom == 2 ? 'selected' : "" }}>2</option>
                    <option value="3" {{ $room->bedroom == 3 ? 'selected' : "" }}>3</option>
                    <option value="4" {{ $room->bedroom == 4 ? 'selected' : "" }}>4+</option>
                </select>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="bathroom" class="">Bathrooms</label>
                <select name="info[bathroom]" id="" class="form-control custom-select" required>
                    <option value="1" {{ $room->bathroom == 1 ? 'selected' : "" }}>1</option>
                    <option value="2" {{ $room->bathroom == 2 ? 'selected' : "" }}>2</option>
                    <option value="3" {{ $room->bathroom == 3 ? 'selected' : "" }}>3</option>
                    <option value="4" {{ $room->bathroom == 4 ? 'selected' : "" }}>4+</option>
                </select>
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Save</button>
        </div>
    </form>

@elseif(Route::currentRouteName() == 'room.pricing')
    
    <form action="{{ route('room.update', ['room' => $room->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row d-flex justify-content-center">
            <div class="form-group col-12 col-md-10">
                <label for="price" class="">Price</label>
                <input type="text" name="info[price]" class="form-control{{ $errors->has('info.price') ? ' is-invalid' : '' }}" value="{{ old('info.price') ?? $room->price }}">
                @include('partials.error_message', ['error' => 'info.price'])
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Save</button>
        </div>
    </form>

@elseif(Route::currentRouteName() == 'room.description')

    <form action="{{ route('room.update', ['room' => $room->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row d-flex justify-content-center">
            <div class="form-group col-12 col-md-10">
                <label for="listing_name" class="">Listing name</label>
                <input type="text" name="info[listing_name]" class="form-control{{ $errors->has('info.listing_name') ? ' is-invalid' : '' }}" value="{{ old('info.listing_name') ?? $room->listing_name }}">
                @include('partials.error_message', ['error' => 'info.listing_name'])
            </div>
            <div class="form-group col-12 col-md-10">
                <label for="summary" class="">Summary</label>
                <textarea class="form-control{{ $errors->has('info.summary') ? ' is-invalid' : '' }}" name="info[summary]" cols="10" rows="10">{{ old('info.summary') ?? $room->summary }}</textarea>
                @include('partials.error_message', ['error' => 'info.summary'])
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Save</button>
        </div>
    </form>

@elseif(Route::currentRouteName() == 'room.photo')
    
    <form action="" method="post">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="form-group col-12 col-md-10">
                <input type="file" name="info[photo]">
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Add photos</button>
        </div>
    </form>

@elseif(Route::currentRouteName() == 'room.amenity')

    <form action="{{ route('room.update', ['room' => $room->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="form-group col-12 col-md-6 col-lg-4">
                <input type="hidden" name="info[has_tv]" value="0">
                <input type="checkbox" name="info[has_tv]" value="1" {{ $room->has_tv == 1 ? 'checked' : "" }}>
                <span>TV</span>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <input type="hidden" name="info[has_kitchen]" value="0">
                <input type="checkbox" name="info[has_kitchen]" value="1" {{ $room->has_kitchen == 1 ? 'checked' : "" }}>
                <span>Kitchen</span>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <input type="hidden" name="info[has_internet]" value="0">
                <input type="checkbox" name="info[has_internet]" value="1" {{ $room->has_internet == 1 ? 'checked' : "" }}>
                <span>Internet</span>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <input type="hidden" name="info[has_heating]" value="0">
                <input type="checkbox" name="info[has_heating]" value="1" {{ $room->has_heating == 1 ? 'checked' : "" }}>
                <span>Heating</span>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4">
                <input type="hidden" name="info[has_air_conditioning]" value="0">
                <input type="checkbox" name="info[has_air_conditioning]" value="1" {{ $room->has_air_conditioning == 1 ? 'checked' : "" }}>
                <span>Air Conditioning</span>
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Save</button>
        </div>
    </form>

@elseif(Route::currentRouteName() == 'room.location')

    <form action="{{ route('room.update', ['room' => $room->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row d-flex justify-content-center">
            <div class="form-group col-12 col-md-10">
                <label for="address" class="">Address</label>
                <input type="text" name="info[address]" class="form-control{{ $errors->has('info.address') ? ' is-invalid' : '' }}" value="{{ old('info.address') ?? $room->address }}">
                @include('partials.error_message', ['error' => 'info.address'])
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Save</button>
        </div>
    </form>

@endif