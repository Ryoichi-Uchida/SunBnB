<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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

    public function make_photos($file, $photo, $filename)
    {
        // For original size.
        $file->storeAs("public/images/$photo->id/original", $filename);

        // For medium size
        $image = Image::make(
            public_path("storage/images/$photo->id/original/$filename")
        );

        $image->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        File::makeDirectory(public_path("storage/images/$photo->id/medium"));

        $image->save(public_path("storage/images/$photo->id/medium/$filename"));


        // For thumb size
        $image = Image::make(
            public_path("storage/images/$photo->id/original/$filename")
        );

        $image->resize(100, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        File::makeDirectory(public_path("storage/images/$photo->id/thumbnail"));
        
        $image->save(public_path("storage/images/$photo->id/thumbnail/$filename"));
    }
}
