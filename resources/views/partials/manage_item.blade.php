@if(Route::currentRouteName() == $name)
    <li class="py-2 text-menu">{{ $view }}</li>
@else
    <li class="py-2"><a href="{{ $route }}" class="link-custom">{{ $view }}</a></li>
@endif