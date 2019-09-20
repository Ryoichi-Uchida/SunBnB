<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = 150)
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function socialAccount()
    {
        return $this->hasOne('App\SocialAccount');
    }

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation', 'user_id');
    }

    public function reviews_from_guest()
    {
        return $this->hasMany('App\Review', 'reviewed_id')->where('reviewer_type', 'guest');
    }

    public function reviews_from_host()
    {
        return $this->hasMany('App\Review', 'reviewed_id')->where('reviewer_type', 'host');
    }

    public function getPhoneNumber() 
    {
        return sprintf("%011d", $this->phone);
    }

    public function totalRate_from_guest()
    {
        return $this->reviews_from_guest()->count();
    }

    public function totalRate_from_host()
    {
        return $this->reviews_from_host()->count();
    }

    public function averageRate_from_guest()
    {
        $rate = $this->reviews_from_guest()->avg('star');

        return round($rate, 0); 
    }

    public function averageRate_from_host()
    {
        $rate = $this->reviews_from_host()->avg('star');
        
        return round($rate, 0); 
    }
}
