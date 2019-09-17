<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;
use Spatie\Geocoder\Facades\Geocoder;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $rooms = Auth::user()->rooms()->orderBy('created_at', 'desc')->paginate(5);

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view("rooms.create");
    }

    public function store(Request $request)
    {
        $room = Auth::user()->rooms()->create($request->all());

        toastr()->success("Successfully created!");

        return redirect()->route("rooms.listing", compact('room'));
    }

    public function show(Room $room)
    {
        return view("rooms.show", compact('room'));
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

        if($request->has('address')){
            $geo = Geocoder::getCoordinatesForAddress($request->address);
            $room->update([
                "longtitude" => $geo['lng'],
                "latitude" => $geo['lat'],
            ]);
        }

        if($request->has('active')){
            toastr()->success("Successfully published!");
        }
        
        return redirect()->back();
    }

    public function publish(Room $room)
    {
        $room->update(["active" => 1]);

        toastr()->success("Successfully published!");

        return redirect()->back();
    }

    // Getting all the reservtions with start_date >= today and end_date >= today.
    public function preload(Room $room)
    {
        $reservations = $room->reservations()
                            ->where(function($query){
                                $query->where('checkin_at', '>=', today())
                                    ->orWhere('checkout_at', '>=', today());
                            })->get();

        if($reservations){
            return response()->json(
                $reservations
            );
        }
    }

    //It calculates conflict when the user input booking form
    public function preshow(Room $room, Request $request)
    {
        $in = Carbon::createFromFormat('Y-m-d', $request->checkin_at);
        $out = Carbon::createFromFormat('Y-m-d', $request->checkout_at);
        
        $conflicts = $room->reservations()->where('checkin_at', '>', $in)->where('checkin_at', '<', $out);

        return response()->json([
            'conflict' => $conflicts->count() ? 1 : 0
        ]);    
    }
}
