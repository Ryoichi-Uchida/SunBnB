<tr>
    <td class="pl-4 w-75 making-menu"><a href="{{ route("rooms.$page", ['room' => $room->id]) }}" class="link-custom">{{ $view }}</a></td>
    <td class="text-main making-menu" id="{{ $id }}">{{ $checked ? "✔" : "" }}</td>
</tr>