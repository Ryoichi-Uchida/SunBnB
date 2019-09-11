<div class="h3 pb-2 border-bottom">
    <span class="h3">Room conditions</span>
</div>
<div class="row">
    <table>
        <tbody class="h4">
            @include('partials.room_item', ['id' => '', 'page' => 'listing', 'view' => 'Listing'])
            @include('partials.room_item', ['id' => '', 'page' => 'pricing', 'view' => 'Pricing', 'filled' => 'filled_pricing'])
            @include('partials.room_item', ['id' => '', 'page' => 'description', 'view' => 'Description', 'filled' => 'filled_description'])
            @include('partials.room_item', ['id' => 'check', 'page' => 'photo', 'view' => 'Photos', 'filled' => 'filled_photos'])
            @include('partials.room_item', ['id' => '', 'page' => 'amenity', 'view' => 'Amenities', 'filled' => 'filled_amenities'])
            @include('partials.room_item', ['id' => '', 'page' => 'location', 'view' => 'Location', 'filled' => 'filled_location'])
        </tbody>
    </table>
</div>
<div class="h3 py-2 border-bottom text-right">
    <form action="{{ route('rooms.update', ['room' => $room->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="active" value="1">
        <div class="form-group text-right">
            <button type="submit" id="disabled" class="btn btn-base btn-size-mini btn-color-main w-50" {{ $room->filled_all() ? "" : "disabled" }}>Publish</button>
        </div>
    </form>
</div>
