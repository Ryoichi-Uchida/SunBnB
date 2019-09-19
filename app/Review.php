<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function host_user()
    {
        return $this->belongsTo("App\user", 'reviewer_id');
    }

    public function guest_user()
    {
        return $this->belongsTo("App\user", 'reviewer_id');
    }

    public function room()
    {
        return $this->belongsTo("App\room");
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }
}
