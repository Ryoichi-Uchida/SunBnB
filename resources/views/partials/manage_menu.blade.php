<div class="h3 pb-2 border-bottom">
    <span class="h3">Your Custom Menu</span>
</div>
<div class="row">
    <div class="col-9">
        <ul class="h4 list pl-2">
            @include('partials.manage_item',['name' => 'rooms.index', 'route' => route('rooms.index'), 'view' => 'Your Listing' ])
            @include('partials.manage_item',['name' => 'reservations.reserves','route' => route('reservations.reserves'), 'view' => 'Your Reserves' ])
            @include('partials.manage_item',['name' => 'reservations.trips','route' => route('reservations.trips'), 'view' => 'Your Trips' ])
        </ul>
    </div>
</div>
