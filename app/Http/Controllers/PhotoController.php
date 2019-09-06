<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Room $room, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photos.*' => ['mimes:jpeg,jpg,png,gif']
        ]);
    
        if($validator->fails()) {
            toastr()->error("The image type is not accepted!");
            
            return back()->withErrors($validator);
        }

        foreach ($request->photos as $file) {

            // Adding image to DB.
            $filename = $file->getClientOriginalName();
            $photo = $room->photos()->create(['image' => $filename]);

            //Making 3 types photos
            $photo->make_base_photo($file, "original", $filename);
            $photo->make_resize_photo($file, "medium", $filename, 300);
            $photo->make_resize_photo($file, "thumb", $filename, 100);
        }

        toastr()->success("Successfully added!");

        return redirect()->back();
    }
}
