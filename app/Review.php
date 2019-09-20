<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo("App\room");
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function reviewer()
    {
         return $this->belongsTo('App\user', 'reviewer_id');
    }
}
