<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function create()
    {
        return view("rooms.create");
    }

    public function store(Request $request)
    {
        $room = Auth::user()->rooms()->create($request->all());

        toastr()->success("Successfully created!");

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
        $request->validate([
            'price' => ['numeric', 'digits_between:1,10'],
            'listing_name' => ['string', 'max:50'],
            'summary' => ['nullable', 'string', 'min:10', 'max:255'],
            'address' => ['string', 'max:255'],
        ]);

        $room->update($request->all());
        
        return redirect()->back();
    }

    public function photo_store(Room $room, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photos.*' => ['mimes:jpeg,jpg,png,gif']
        ]);
    
        if($validator->fails()) {
            toastr()->error("The image type is not accepted!");
            
            return back()->withErrors($validator);
        }

        foreach ($request->photos as $file) {

            // Adding image to DB.
            $filename = $file->getClientOriginalName();
            $photo = $room->photos()->create(['image' => $filename]);

            //Making 3 types photos
            $photo->savePhoto($file, "original");
            $photo->resize($file, "medium", 300);
            $photo->resize($file, "thumbnail", 100);
        }

        toastr()->success("Successfully added!");

        return redirect()->back();
    }
}
