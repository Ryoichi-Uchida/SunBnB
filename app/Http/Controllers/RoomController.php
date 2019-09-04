<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;

class RoomController extends Controller
{
    public function create()
    {
        return view("rooms.create");
    }

    public function store(Request $request)
    {
        $room = Auth::user()->rooms()->create($request->all());

        return redirect()->route("room.listing", compact('room'));
    }

    public function listing(Room $room)
    {
        return view("rooms.listing", compact('room'));
    }

    public function pricing(Room $room)
    {
        return view("rooms.pricing", compact('room'));
    }

    public function description(Room $room)
    {
        return view("rooms.description", compact('room'));
    }

    public function photo(Room $room)
    {
        return view("rooms.photo", compact('room'));
    }

    public function amenity(Room $room)
    {
        return view("rooms.amenity", compact('room'));
    }

    public function location(Room $room)
    {
        return view("rooms.location", compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        // For price area
        if(($request->has('info.price'))){
            $request->validate([
                'info.price' => ['required', 'numeric', 'digits_between:1,10'],
            ]);
        }

        // For description area
        if(($request->has('info.listing_name'))){
            $request->validate([
                'info.listing_name' => ['required', 'string', 'max:50'],
                'info.summary' => ['required', 'string', 'min:10', 'max:255'],
            ]);
        }

        // For location area
        if(($request->has('info.address'))){
            $request->validate([
                'info.address' => ['required', 'string', 'max:255'],
            ]);
        }

        foreach ($request->info as $key => $value) {
            $room->update([$key => $value]);
        }
        
        return redirect()->back();
    }
}
