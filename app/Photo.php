<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class Photo extends Model
{
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function images_directry($size)
    {
    return "storage/images/{$this->id}/{$size}";
    }

    public function make_base_photo($file, $size, $filename)
    {
        $file->storeAs("public/images/{$this->id}/$size", $filename);
    }

    public function make_resize_photo($file, $size, $filename, $width)
    {
        $this->make_base_photo($file, $size, $filename);

        $image = Image::make(
            public_path($this->images_directry($size)."/{$filename}")
        );

        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save(public_path($this->images_directry($size)."/{$filename}"));
    }

}
