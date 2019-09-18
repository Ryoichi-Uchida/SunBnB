<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded =[];

    protected $table = 'user_room';

    public function user()
    {
        return $this->belongsTo('App\user');
    }

    public function room()
    {
        return $this->belongsTo('App\room');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
