<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $guarded = [];

    public $sizes = [
        "original" => null,
        "medium" => 300,
        "thumbnail" => 100
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function($photo){
            Storage::disk('s3')->deleteDirectory("storage/images/{$photo->id}");
        });
    }

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function image_directory($size)
    {
        return "storage/images/{$this->id}/{$size}/{$this->image}";
    }

    public function savePhoto($file)
    {
        foreach ($this->sizes as $size => $width) {
            $image = Image::make($file);

            if(!is_null($width)){
                $image->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            // It saves image file to S3
            Storage::disk('s3')->put($this->image_directory($size), $image->encode(), 'public');
        };
    }

    public function show($size)
    {
        return Storage::disk('s3')->url($this->image_directory($size));
    }
}
