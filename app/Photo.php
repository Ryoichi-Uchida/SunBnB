<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function image_directory($size)
    {
    return "storage/images/{$this->id}/{$size}/{$this->image}";
    }

    public function savePhoto($file, $size)
    {
        $file->storeAs("public/images/{$this->id}/$size", $this->image);
    }

    public function resize($file, $size, $width)
    {
        $this->savePhoto($file, $size);

        $image = Image::make(
            public_path($this->image_directory($size))
        );

        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save(public_path($this->image_directory($size)));
    }

    public function delete_photoDirectory()
    {
        Storage::deleteDirectory(
            "public/images/{$this->id}"
        );
    }

}
