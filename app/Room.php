<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function filled_pricing()
    {
        if(!empty($this->price)){
            return true;
        }else{
            return false;
        }
    }

    public function filled_description()
    {
        if(!empty($this->listing_name)){
            return true;
        }else{
            return false;
        }
    }

    public function filled_photos()
    {
        if(!empty($this->photos->first())){
            return true;
        }else{
            return false;
        }
    }

    public function filled_amenities()
    {
        if(isset($this->has_tv)){
            return true;
        }else{
            return false;
        }
    }

    public function filled_location()
    {
        if(!empty($this->address)){
            return true;
        }else{
            return false;
        }
    }

    public function filled_all()
    {
        if(
            $this->filled_pricing() &&
            $this->filled_description() &&
            $this->filled_photos() &&
            $this->filled_amenities() &&
            $this->filled_location()
        ){
            return true;
        }else{
            return false;
        }
    }
}
