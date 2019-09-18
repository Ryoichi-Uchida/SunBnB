@if($user->socialAccount))
    <img class="rounded-circle {{ $img_size }}" src="{{ $user->socialAccount->image }}">
@else
    <img class="rounded-circle" src="{{ $user->gravatar($gravatar_size) }}">
@endif