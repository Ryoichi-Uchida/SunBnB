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
        $rooms = Room::where('active', 1)->orderBy('created_at', 'desc')->take(6)->get();
        return view('pages.home', compact('rooms'));
    }

    public function search(Request $request)
    {
        // dd($request->all());
        // $request->session()->put('address', $request->address);
        
        // dd($request->session()->all());

        if($request->query()){
            $rooms  = Room::active();
            
            if($request->address){
                $request->session()->put('address', $request->address);
                $geo = Geocoder::getCoordinatesForAddress($request->address);
                $rooms = $rooms->near(5, $geo['lat'], $geo['lng']);
            }

            if($request->checkin || $request->checkout){
                $request->session()->put('checkin', $request->checkin);

                $validator = Validator::make($request->all(), [
                    'checkin' => ['nullable', 'required_with:checkout'],
                    'checkout' => ['nullable', 'required_with:checkin']
                ]);

                if($validator->fails()) {
                    toastr()->error("Please fill both of start & end date!");
                    
                    return back();
                }
                
                $rooms = $rooms->whereHas('reservations', function($q) use($request){
                    $q->Where('checkout_at', '<=', $request->checkin)
                        ->orWhere('checkin_at', '>=', $request->checkout);
                });
            }

            if($request->min_price){
                $request->session()->put('min_price', $request->min_price);
                $rooms = $rooms->minPrice($request->min_price);
            }

            if($request->max_price){
                $request->session()->put('max_price', $request->max_price);
                $rooms = $rooms->maxPrice($request->max_price);
            }

            if($request->room_types)
            {
                $request->session()->put('room_types', $request->room_types);
                $rooms = $rooms->roomTypes($request->room_types);
            }

            if($request->accomodate){
                $request->session()->put('accomodate', $request->accomodate);
                $rooms = $rooms->accomodate($request->accomodate);
            }

            if($request->bedroom){
                $request->session()->put('bedroom', $request->bedroom);
                $rooms = $rooms->bedroom($request->bedroom);
            }

            if($request->bathroom){
                $request->session()->put('bathroom', $request->bathroom);
                $rooms = $rooms->bathroom($request->bathroom);
            }

            if(!is_null($request->has_tv)){
                $request->session()->put('has_tv', $request->has_tv);
                $rooms = $rooms->hasTV($request->has_tv);
            }

            if(!is_null($request->has_kitchen)){
                $request->session()->put('has_kitchen', $request->has_kitchen);
                $rooms = $rooms->hasKitchen($request->has_kitchen);
            }

            if(!is_null($request->has_internet)){
                $request->session()->put('has_internet', $request->has_internet);
                $rooms = $rooms->hasInternet($request->has_internet);
            }

            if(!is_null($request->has_heating)){
                $request->session()->put('has_heating', $request->has_heating);                
                $rooms = $rooms->hasHeating($request->has_heating);
            }

            if(!is_null($request->has_air_conditioning)){
                $request->session()->put('has_air_conditioning', $request->has_air_conditioning);                                
                $rooms = $rooms->hasAirConditioning($request->has_air_conditioning);
            }

            $rooms = $rooms->get();
        }

        return view('pages.search', [
            'rooms' => $rooms ?? []
        ]);

    }
}
