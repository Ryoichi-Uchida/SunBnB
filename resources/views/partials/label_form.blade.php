<label for="{{ $name }}">{{ $text }}</label>
<input type="{{ $type }}" name="{{ $name }}" class="form-control" value="{{ session($name) }}" id="{{ $name }}">