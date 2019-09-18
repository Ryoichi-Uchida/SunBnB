<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Request $request, Room $room)
    {
        if(Auth::user()->id == $room->user->id){
            toastr()->error("It's your room, so you can't reserve");
        }else{
            // These are calculating total price the user will pay.
            $in = new Carbon($request->checkin);
            $out = new Carbon($request->checkout);
            $diff = $in->diffInDays($out);
            $total_price = $room->price * $diff;
    
            Auth::user()->reservations()->create([
                'room_id' => $room->id,
                'checkin_at' => $request->checkin,
                'checkout_at' => $request->checkout,
                'total_price' => $total_price
            ]);
    
            toastr()->success("Successfully reserved!");
        }
        return redirect()->back();
    }

    public function reserves()
    {
        $reservations = Reservation::whereHas('room', function($query){
            $query->where('user_id', Auth::user()->id);
        })->orderBy('checkin_at')->paginate(10);
        
        return view('reservations.reserves', compact('reservations'));
    }

    public function trips()
    {
        $reservations = Auth::user()->reservations()->orderBy('checkin_at')->paginate(10);
        
        return view('reservations.trips', compact('reservations'));
    }
}
