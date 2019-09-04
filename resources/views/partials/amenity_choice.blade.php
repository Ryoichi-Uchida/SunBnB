<input type="hidden" name="{{ $name }}" value="0">
<input type="checkbox" name="{{ $name }}" value="1" {{ $is_checked == 1 ? 'checked' : "" }}>
<span>{{ $view }}</span>