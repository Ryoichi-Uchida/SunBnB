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

    public function show_photo($size)
    {
        if($this->photos()->exists()){
            // Showing first image from s3
            return $this->photos->first()->show($size);
        }else{
            return "/images/blank.jpg";
        }
    }

    public function near_rooms()
    {
        // It is Distance to search rooms(km)
        $radius = 10;
        // It calculates km from this instance(It's just text data).
        $prepare = "(6378 * acos(
                    cos(radians($this->latitude)) * 
                    cos(radians(latitude)) * 
                    cos(radians(longtitude) - radians($this->longtitude)) + 
                    sin(radians($this->latitude)) * 
                    sin(radians(latitude)))
        )";

        //
        return Room::select('*')
                    //It makes new attribute "as" distance.
                    //We can retrieve distance from this instance ($room->distance)
                    ->selectRaw("$prepare AS distance")
                    ->having("distance", "<", $radius)
                    ->where('id', '!=', $this->id)
                    ->orderBy("distance")
                    ->get();
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
}
