<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Reservation;
use App\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Request $request, Reservation $reservation)
    {
        if($request->reviewer_type == 'guest'){
            $reviewed_target_id = $reservation->room->user->id;
            $reviewer_type = 'guest';
        }else{
            $reviewed_target_id = $reservation->user->id;
            $reviewer_type = 'host';
        }

        if(Review::Where('reviewer_type', $reviewer_type)->where('reservation_id', $reservation->id)->count()){
            return Response::json([
                'message' => "You already created review about this trip!",
                'error' => "1",
            ]);
        }

        $reservation->reviews()->create([
            'reviewer_id' => Auth::user()->id,
            'reviewed_id' => $reviewed_target_id,
            'reviewer_type' => $reviewer_type,
            'room_id' => $reservation->room->id,
            'star' => $request->star,
            'comment' => $request->comment
        ]);
        
        return Response::json([
            'message' => "Review was created!"
        ]);
    }

}
