<label for="home_type" class="">{{ $label }}</label>
<select name="{{ $name }}" id="" class="form-control custom-select" {{ $required }}>
    <option value="" disabled selected>Select..</option>
    @foreach ($options as $option)
        <option value="{{ $option }}" {{ $selected == $option ? 'selected' : "" }}>{{ $option == 4 ? $option.'+' : $option }}</option>
    @endforeach
</select>