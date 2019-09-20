<input type="checkbox" name="room_types[{{ $name }}]" value="{{ $name }}" {{ session('room_types.'.$name) != "" ? 'checked' : "" }}>
<span>{{ $text }}</span>