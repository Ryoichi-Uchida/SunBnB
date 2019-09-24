<label for="{{ $name }}">{{ $text }}</label>
<input type="number" name="{{ $name }}" class="form-control" value="{{ session($name) }}" id="{{ $name }}">