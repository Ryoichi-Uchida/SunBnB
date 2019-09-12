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
            return Storage::disk('s3')->url($this->photos->first()->image_directory($size));
        }else{
            return "/images/blank.jpg";
        }
    }
}
