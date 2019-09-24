<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Room extends Model
{
    protected $guarded = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation', 'room_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function filled_all()
    {
        if(
            $this->price &&
            $this->listing_name &&
            $this->photos->count() &&
            $this->address
        ){
            return true;
        }else{
            return false;
        }
    }

    public function near_rooms()
    {
        return Room::near(10, $this->latitude, $this->longtitude)->get();
    }

    public function show_photo($size)
    {
        if($this->photos()->exists()){
            // Showing first image from s3
            return $this->photos->first()->show($size);
        }else{
            return "/images/blank.jpg";
        }
    }

    public function totalRate()
    {
        return $this->reviews()->where('reviewer_type', 'guest')->count();
    }

    public function averageRate()
    {
        $rate = $this->reviews()->where('reviewer_type', 'guest')->avg('star');
        return round($rate, 0); 
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeNear($query, $radius, $latitude, $longtitude)
    {
        $prepare = "(6378 * acos(
                    cos(radians($latitude)) * 
                    cos(radians(latitude)) * 
                    cos(radians(longtitude) - radians($longtitude)) + 
                    sin(radians($latitude)) * 
                    sin(radians(latitude)))
        )";

        return $query->select('*')
                    //It makes new attribute "as" distance.
                    //We can retrieve distance from this instance ($room->distance)
                    ->selectRaw("$prepare AS distance")
                    ->having("distance", "<", $radius)
                    ->where('id', '!=', $this->id)
                    ->orderBy("distance");
    }

    public function scopeDate($query, $checkin, $checkout)
    {
        return $query->whereHas('reservations', function($q) use($checkin, $checkout){
                    $q->Where('checkout_at', '<=', $checkin)
                        ->orWhere('checkin_at', '>=', $checkout);
        });
    }
    

    public function scopeMinPrice($query, $price)
    {
        return $query->where('price', '>=', $price);
    }

    public function scopeMaxPrice($query, $price)
    {
        return $query->where('price', '<=', $price);
    }

    public function scopeRoomTypes($query, $room_types)
    {
        return $query->whereIn('room_type', $room_types);
    }

    public function scopeAccomodate($query, $accomodate)
    {
        return $query->where('accomodate', $accomodate);
    }

    public function scopeBedroom($query, $bedroom)
    {
        return $query->where('bedroom', $bedroom);
    }

    public function scopeBathroom($query, $bathroom)
    {
        return $query->where('bathroom', $bathroom);
    }

    public function scopeHasTV($query, $has_tv)
    {
        return $query->where('has_tv', $has_tv);
    }

    public function scopeHasKitchen($query, $has_kitchen)
    {
        return $query->where('has_kitchen', $has_kitchen);
    }

    public function scopeHasInternet($query, $has_internet)
    {
        return $query->where('has_internet', $has_internet);
    }

    public function scopeHasHeating($query, $has_heating)
    {
        return $query->where('has_heating', $has_heating);
    }

    public function scopeHasAirConditioning($query, $has_air_conditioning)
    {
        return $query->where('has_air_conditioning', $has_air_conditioning);
    }

}
