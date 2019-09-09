<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Photo;

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
            $photo->savePhoto($file, "original");
            $photo->resize($file, "medium", 300);
            $photo->resize($file, "thumbnail", 100);
        }

        toastr()->success("Successfully added!");

        return redirect()->back();
    }

    public function destroy($id)
    {
        $photo = Photo::where('id', $id)->first();
        $photo->delete();

        return Response::json([
            'message' => "delete success!"
        ]);

        return Response::json([
            'message' => "delete failed.."
        ]);
    }
}
