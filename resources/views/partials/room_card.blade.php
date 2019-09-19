<div class="col-12 col-sm-6 col-lg-4 my-2">
    <div class="card">
        <img class="card-img-top" src="{{ $room->show_photo("original") }}">
        <div class="card-body py-2">
            <div class="row">
                <div class="col-9">
                    <h5><a href="{{ route('rooms.show', ['room' => $room->id]) }}">{{ $room->listing_name }}</a></h5>
                    <h5>${{ $room->price }} - {{ $room->home_type }} - {{ $room->room_type }}</h5>
                    <div class="star" data-score="{{ $room->averageRate() }}"></div>
                    <h5>{{ $room->totalRate() }} reviews</h5>
                </div>
            </div>
        </div>
    </div>
</div>