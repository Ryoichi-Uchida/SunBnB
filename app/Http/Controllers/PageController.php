<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Spatie\Geocoder\Facades\Geocoder;
use Illuminate\Support\Facades\Validator;
use App\Reservation;

class PageController extends Controller
{
    public function index()
    {
        session()->forget([
            'address',
            'checkin',
            'checkout',
            'min_price',
            'max_price',
            'room_types',
            'accomodate',
            'bedroom',
            'bathroom',
            'has_tv',
            'has_kitchen',
            'has_internet',
            'has_heating',
            'has_air_conditioning'
        ]);

        $rooms = Room::where('active', 1)->orderBy('created_at', 'desc')->take(6)->get();
        return view('pages.home', compact('rooms'));
    }

    public function search(Request $request)
    {
        $request->session()->put([
            'address' => $request->address,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'room_types' => $request->room_types,
            'accomodate' => $request->accomodate,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'has_tv' => $request->has_tv,
            'has_kitchen' => $request->has_kitchen,
            'has_internet' => $request->has_internet,
            'has_heating' => $request->has_heating,
            'has_air_conditioning' => $request->has_air_conditioning
        ]);

        if($request->query()){
            $rooms  = Room::active();
            
            if($request->address){
                $geo = Geocoder::getCoordinatesForAddress($request->address);
                $rooms = $rooms->near(5, $geo['lat'], $geo['lng']);
            }

            if($request->checkin || $request->checkout){
                $validator = Validator::make($request->all(), [
                    'checkin' => ['nullable', 'required_with:checkout'],
                    'checkout' => ['nullable', 'required_with:checkin']
                ]);

                if($validator->fails()) {
                    toastr()->error("Please fill both of start & end date!");
                    
                    return redirect()->back();
                }

                $rooms = $rooms->date($request->checkin, $request->checkout);
            }

            if($request->min_price){
                $rooms = $rooms->minPrice($request->min_price);
            }

            if($request->max_price){
                $rooms = $rooms->maxPrice($request->max_price);
            }

            if($request->room_types)
            {
                $rooms = $rooms->roomTypes($request->room_types);
            }

            if($request->accomodate){
                $rooms = $rooms->accomodate($request->accomodate);
            }

            if($request->bedroom){
                $rooms = $rooms->bedroom($request->bedroom);
            }

            if($request->bathroom){
                $rooms = $rooms->bathroom($request->bathroom);
            }

            if($request->has_tv){
                $rooms = $rooms->hasTV($request->has_tv);
            }

            if($request->has_kitchen){
                $rooms = $rooms->hasKitchen($request->has_kitchen);
            }

            if($request->has_internet){
                $rooms = $rooms->hasInternet($request->has_internet);
            }

            if($request->has_heating){
                $rooms = $rooms->hasHeating($request->has_heating);
            }

            if($request->has_air_conditioning){
                $rooms = $rooms->hasAirConditioning($request->has_air_conditioning);
            }

            $rooms = $rooms->get();
        }

        return view('pages.search', compact('rooms'));
    }
}
