<div class="h3 pb-2 border-bottom">
    <span class="h3">Room conditions</span>
</div>
<div class="row">
    <table>
        <tbody class="h4">
            @include('partials.room_item', ['id' => '', 'page' => 'listing', 'view' => 'Listing', 'checked' => "checked"])
            @include('partials.room_item', ['id' => '', 'page' => 'pricing', 'view' => 'Pricing', 'checked' => $room->price])
            @include('partials.room_item', ['id' => '', 'page' => 'description', 'view' => 'Description', 'checked' => $room->listing_name])
            @include('partials.room_item', ['id' => 'check', 'page' => 'photo', 'view' => 'Photos', 'checked' => $room->photos()->exists()])
            @include('partials.room_item', ['id' => '', 'page' => 'amenity', 'view' => 'Amenities', 'checked' => "checked"])
            @include('partials.room_item', ['id' => '', 'page' => 'location', 'view' => 'Location', 'checked' => $room->address])
        </tbody>
    </table>
</div>
<div class="h3 py-2 border-bottom text-right">
    <form action="{{ route('rooms.publish', ['room' => $room->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group text-right">
            <button type="submit" id="disabled" class="btn btn-base btn-size-mini btn-color-main w-50" {{ $room->filled_all() ? "" : "disabled" }}>Publish</button>
        </div>
    </form>
</div>
