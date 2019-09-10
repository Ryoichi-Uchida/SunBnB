<div class="h3 pb-2 border-bottom">
    <span class="h3">Room conditions</span>
</div>
<div class="row">
    <div class="col-9">
        <ul class="h5 list pl-4">
            <li class="py-2"><a href="{{ route('rooms.listing', ['room' => $room->id]) }}" class="link-custom">Listing</a></li>
            <li class="py-2"><a href="{{ route('rooms.pricing', ['room' => $room->id]) }}" class="link-custom">Pricing</a></li>
            <li class="py-2"><a href="{{ route('rooms.description', ['room' => $room->id]) }}" class="link-custom">Description</a></li>
            <li class="py-2"><a href="{{ route('rooms.photo', ['room' => $room->id]) }}" class="link-custom">Photos</a></li>
            <li class="py-2"><a href="{{ route('rooms.amenity', ['room' => $room->id]) }}" class="link-custom">Amenities</a></li>
            <li class="py-2"><a href="{{ route('rooms.location', ['room' => $room->id]) }}" class="link-custom">Location</a></li>
        </ul>
    </div>
    <div class="col-3">
        <ul class="h5 list pl-0">
            <li class="text-main py-2">✔︎</li>
            <li class="text-main py-2">✔︎</li>
            <li class="text-main py-2">✔︎</li>
            <li class="text-main py-2">✔︎</li>
            <li class="text-main py-2">✔︎</li>
            <li class="text-main py-2">✔︎</li>
        </ul>
    </div>
</div>
<div class="h3 py-2 border-bottom text-right">
    <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-50">Publish</button>
</div>