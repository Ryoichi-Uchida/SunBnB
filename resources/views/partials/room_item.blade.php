<tr>
    <td class="pl-4 w-75 room-list"><a href="{{ route("rooms.$page", ['room' => $room->id]) }}" class="link-custom">{{ $view }}</a></td>
    <td class="text-main room-list" id="{{ $id }}">{{ $checked ? "✔" : "" }}</td>
</tr>