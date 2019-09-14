<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded =[];

    protected $table = 'user_room';

    public function user()
    {
        $this->belongsTo('App\user');
    }

    public function room()
    {
        $this->belongsTo('App\room');
    }
}
