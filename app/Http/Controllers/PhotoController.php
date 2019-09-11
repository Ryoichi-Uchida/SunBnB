<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Photo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

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
            $photo->savePhoto($file);
        }

        toastr()->success("Successfully added!");

        return redirect()->back();
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);

        if($photo->delete()){

            // (Memo)
            // static boot() function is called automatically and delete directory from S3
            // when this instance is deleted.
            
            return Response::json([
                'message' => "delete success!"
            ]);
        }else{
            return Response::json([
                'message' => "delete failed.."
            ]);
        }
    }
}
