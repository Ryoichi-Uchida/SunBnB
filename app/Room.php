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
        $radius = 10;
        // It calculates km from this instance.
        $prepare = "(6378 * acos(
                    cos(radians($this->latitude)) * 
                    cos(radians(latitude)) * 
                    cos(radians(longtitude) - radians($this->longtitude)) + 
                    sin(radians($this->latitude)) * 
                    sin(radians(latitude)))
        )";

        return Room::select('*')
                    ->selectRaw("{$prepare} AS distance")
                    ->having("distance", "<", $radius)
                    ->where('id', '!=', $this->id)
                    ->orderBy("distance")
                    ->get();
    }
}
