<div class="row">
    <div class="form-group col-12 col-md-6 col-lg-4">
        <input type="hidden" name="has_tv" value="0">
        <input type="checkbox" name="has_tv" value="1" {{ $room->has_tv == 1 ? 'checked' : "" }}>
        <span>TV</span>
    </div>
    <div class="form-group col-12 col-md-6 col-lg-4">
        <input type="hidden" name="has_kitchen" value="0">
        <input type="checkbox" name="has_kitchen" value="1" {{ $room->has_kitchen == 1 ? 'checked' : "" }}>
        <span>Kitchen</span>
    </div>
    <div class="form-group col-12 col-md-6 col-lg-4">
        <input type="hidden" name="has_internet" value="0">
        <input type="checkbox" name="has_internet" value="1" {{ $room->has_internet == 1 ? 'checked' : "" }}>
        <span>Internet</span>
    </div>
    <div class="form-group col-12 col-md-6 col-lg-4">
        <input type="hidden" name="has_heating" value="0">
        <input type="checkbox" name="has_heating" value="1" {{ $room->has_heating == 1 ? 'checked' : "" }}>
        <span>Heating</span>
    </div>
    <div class="form-group col-12 col-md-6 col-lg-4">
        <input type="hidden" name="has_air_conditioning" value="0">
        <input type="checkbox" name="has_air_conditioning" value="1" {{ $room->has_air_conditioning == 1 ? 'checked' : "" }}>
        <span>Air Conditioning</span>
    </div>
</div>