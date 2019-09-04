<label for="home_type" class="">{{ $label }}</label>
<select name="{{ $name }}" id="" class="form-control custom-select" required>
    <option value="" disabled selected>Select..</option>
    @foreach ($options as $option)
        @if ($option == 4)
            <option value="{{ $option }}" {{ $selected == $option ? 'selected' : "" }}>{{ $option }}+</option>
        @else
            <option value="{{ $option }}" {{ $selected == $option ? 'selected' : "" }}>{{ $option }}</option>   
        @endif
    @endforeach
</select>