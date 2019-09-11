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

    public function filled_all()
    {
        if(
            $this->price &&
            $this->listing_name &&
            $this->photos->count() &&
            $this->has_tv &&
            $this->address
        ){
            return true;
        }else{
            return false;
        }
    }
}
